<?php

namespace App\Entity\Customer;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Entity\Customer;
use App\Repository\Customer\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ApiResource(
    security: "is_granted('ROLE_USER')",
    routePrefix: '/customers',
    normalizationContext: []
)]
#[Get(security: "is_granted('ROLE_USER') and object.customer == user")]
#[GetCollection]
#[Put(security: "is_granted('ROLE_USER') and object.customer == user")]
#[Post(security: "is_granted('ROLE_USER')")]
#[Delete(security: "is_granted('ROLE_USER') and object.customer == user")]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fulladdress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postalcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $municipality = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $province = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fax = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cel_phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pec = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $website = null;

    #[ORM\OneToOne(mappedBy: 'contact', cascade: ['persist', 'remove'])]
    public ?Customer $customer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullAddress(): ?string
    {
        return $this->fulladdress;
    }

    public function setFullAddress(?string $fulladdress): self
    {
        $this->fulladdress = $fulladdress;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalcode;
    }

    public function setPostalCode(?string $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getMunicipality(): ?string
    {
        return $this->municipality;
    }

    public function setMunicipality(?string $municipality): self
    {
        $this->municipality = $municipality;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getCelPhone(): ?string
    {
        return $this->cel_phone;
    }

    public function setCelPhone(?string $cel_phone): self
    {
        $this->cel_phone = $cel_phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPec(): ?string
    {
        return $this->pec;
    }

    public function setPec(?string $pec): self
    {
        $this->pec = $pec;

        return $this;
    }

    public function getWebSite(): ?string
    {
        return $this->website;
    }

    public function setWebSite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        // unset the owning side of the relation if necessary
        if ($customer === null && $this->customer !== null) {
            $this->customer->setContact(null);
        }

        // set the owning side of the relation if necessary
        if ($customer !== null && $customer->getContact() !== $this) {
            $customer->setContact($this);
        }

        $this->customer = $customer;

        return $this;
    }
}
