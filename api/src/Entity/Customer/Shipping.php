<?php

namespace App\Entity\Customer;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Entity\Customer;
use App\Repository\Customer\ShippingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShippingRepository::class)]
#[ApiResource(
    security: "is_granted('ROLE_ADMIN')",
    routePrefix: '/customers'
)]
#[Get(security: "is_granted('ROLE_USER') and object.customer == user")]
#[GetCollection]
#[Put(security: "is_granted('ROLE_USER') and object.customer == user")]
#[Post(security: "is_granted('ROLE_USER')")]
#[Delete(security: "is_granted('ROLE_USER') and object.customer == user")]
class Shipping
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isdefault = FALSE;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $businessname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vatnumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fisclacode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postalcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $province = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state = 'ITALY';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fax = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $celphone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'shippings')]
    #[ORM\JoinColumn(nullable: false)]
    public ?Customer $customer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsDefault(): ?bool
    {
        return $this->isdefault;
    }

    public function setIsDefault(bool $isdefault): self
    {
        $this->isdefault = $isdefault;

        return $this;
    }

    public function getBusinessName(): ?string
    {
        return $this->businessname;
    }

    public function setBusinessName(?string $businessname): self
    {
        $this->businessname = $businessname;

        return $this;
    }

    public function getVatNumber(): ?string
    {
        return $this->vatnumber;
    }

    public function setVatNumber(?string $vatnumber): self
    {
        $this->vatnumber = $vatnumber;

        return $this;
    }

    public function getFiscalCode(): ?string
    {
        return $this->fisclacode;
    }

    public function setFiscalCode(?string $fisclacode): self
    {
        $this->fisclacode = $fisclacode;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

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

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

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
        return $this->celphone;
    }

    public function setCelPhone(?string $celphone): self
    {
        $this->celphone = $celphone;

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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
