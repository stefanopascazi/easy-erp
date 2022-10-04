<?php

namespace App\Entity;

use App\Entity\Customer\Contact;
use App\Entity\Customer\CustomerCategory;
use App\Entity\Customer\Shipping;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Events\CustomerListener;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ORM\EntityListeners([CustomerListener::class])]
#[ApiResource(security: "is_granted('ROLE_ADMIN')")]
#[Get(security: "is_granted('ROLE_USER') and object == user")]
#[GetCollection]
#[Put(security: "is_granted('ROLE_USER') and object == user")]
#[Post(security: "is_granted('PUBLIC_ACCESS')")]
#[Delete(security: "is_granted('ROLE_USER') and object == user")]
#[UniqueEntity('email')]
class Customer implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $type = 0;

    #[ORM\ManyToOne(inversedBy: 'customers')]
    private ?CustomerCategory $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $surname = null;

    #[ORM\Column]
    private ?int $obsolete = 0;

    #[ORM\Column]
    private ?int $person = 0;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Shipping::class, orphanRemoval: true)]
    private Collection $shippings;

    #[ORM\OneToOne(inversedBy: 'customer', cascade: ['persist', 'remove'])]
    private ?Contact $contact = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $businessname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $externalcode = null;

    public function __construct()
    {
        $this->shippings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * SetType is around 0 - 3
     * 0 = customer
     * 1 = supplier
     * 2 = customer/supplier
     * 3 = temporary
     *
     * @param integer $type
     * @return self
     */
    public function setType(int $type): self
    {
        (array) $types = [
            0,1,2,3
        ];

        $this->type = in_array($type, $types) ? $type : 0;

        return $this;
    }

    public function getCategory(): ?CustomerCategory
    {
        return $this->category;
    }

    public function setCategory(?CustomerCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getObsolete(): ?int
    {
        return $this->obsolete;
    }

    public function setObsolete(int $obsolete): self
    {
        $this->obsolete = $obsolete;

        return $this;
    }

    public function getPerson(): ?int
    {
        return $this->person;
    }

    public function setPerson(int $person): self
    {
        $this->person = $person;

        return $this;
    }

    /**
     * @return Collection<int, Shipping>
     */
    public function getShippings(): Collection
    {
        return $this->shippings;
    }

    public function addShipping(Shipping $shipping): self
    {
        if (!$this->shippings->contains($shipping)) {
            $this->shippings->add($shipping);
            $shipping->setCustomer($this);
        }

        return $this;
    }

    public function removeShipping(Shipping $shipping): self
    {
        if ($this->shippings->removeElement($shipping)) {
            // set the owning side to null (unless already changed)
            if ($shipping->getCustomer() === $this) {
                $shipping->setCustomer(null);
            }
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getBusinessname(): ?string
    {
        return $this->businessname;
    }

    public function setBusinessname(?string $businessname): self
    {
        $this->businessname = $businessname;

        return $this;
    }

    public function getExternalcode(): ?string
    {
        return $this->externalcode;
    }

    public function setExternalcode(?string $externalcode): self
    {
        $this->externalcode = $externalcode;

        return $this;
    }
}
