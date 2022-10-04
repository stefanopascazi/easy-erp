<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SettingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
#[ApiResource(
    security: "is_granted('ROLE_ADMIN')",
    routePrefix: '/admin'
)]
class Setting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $province = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fax = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pec = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $businessname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vatnumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fiscalcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postalcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $website = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $businessemail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $invoicecode = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPec(): ?string
    {
        return $this->pec;
    }

    public function setPec(?string $pec): self
    {
        $this->pec = $pec;

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

    public function getVatnumber(): ?string
    {
        return $this->vatnumber;
    }

    public function setVatnumber(?string $vatnumber): self
    {
        $this->vatnumber = $vatnumber;

        return $this;
    }

    public function getFiscalcode(): ?string
    {
        return $this->fiscalcode;
    }

    public function setFiscalcode(?string $fiscalcode): self
    {
        $this->fiscalcode = $fiscalcode;

        return $this;
    }

    public function getPostalcode(): ?string
    {
        return $this->postalcode;
    }

    public function setPostalcode(?string $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getBusinessemail(): ?string
    {
        return $this->businessemail;
    }

    public function setBusinessemail(?string $businessemail): self
    {
        $this->businessemail = $businessemail;

        return $this;
    }

    public function getInvoicecode(): ?string
    {
        return $this->invoicecode;
    }

    public function setInvoicecode(?string $invoicecode): self
    {
        $this->invoicecode = $invoicecode;

        return $this;
    }
}
