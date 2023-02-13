<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PropertyRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PropertyRepository::class)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Votre titre est trop court. Il doit contenir au minimum 5 caractères',
        maxMessage: 'Votre titre est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $Title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\Range(
        min: 10,
        max: 400,
        notInRangeMessage: 'Cette valeur doit être comprise entre 10cm² et 400cm²',
    )]
    private ?float $Surface = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\Range(
        min: 2,
        notInRangeMessage: 'Cette valeur doit être au moins égale à 2',
    )]
    private ?int $Rooms = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?int $Bedrooms = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotNull()]
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'La valeur de ce champ est trop court. Il doit contenir au minimum 5 caractères',
        maxMessage: 'La valeur de ce champ est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $Address = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        max: 50,
        maxMessage: 'La valeur de ce champ est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $Additional_address = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotNull()]
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'La valeur de ce champ est trop court. Il doit contenir au minimum 5 caractères',
        maxMessage: 'La valeur de ce champ est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $City = null;

    #[ORM\Column]
    #[Assert\Regex('/^[0-9]{5}$/')]
    private ?string $Postal_code = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\Positive()]
    private ?float $Price_charges = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\Positive()]
    private ?float $Rent_price = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    #[Assert\Positive()]
    private ?float $Security_deposit_price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $UpdatedAt = null;


    #[ORM\ManyToOne(inversedBy: 'property')]
    private ?Tenant $tenant = null;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->CreatedAt = new DateTimeImmutable();
        $this->UpdatedAt = new \DateTimeImmutable();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->Surface;
    }

    public function setSurface(float $Surface): self
    {
        $this->Surface = $Surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->Rooms;
    }

    public function setRooms(int $Rooms): self
    {
        $this->Rooms = $Rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->Bedrooms;
    }

    public function setBedrooms(int $Bedrooms): self
    {
        $this->Bedrooms = $Bedrooms;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getAdditionalAddress(): ?string
    {
        return $this->Additional_address;
    }

    public function setAdditionalAddress(?string $Additional_address): self
    {
        $this->Additional_address = $Additional_address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->Postal_code;
    }

    public function setPostalCode(string $Postal_code): self
    {
        $this->Postal_code = $Postal_code;

        return $this;
    }

    public function getPriceCharges(): ?float
    {
        return $this->Price_charges;
    }

    public function setPriceCharges(float $Price_charges): self
    {
        $this->Price_charges = $Price_charges;

        return $this;
    }

    public function getRentPrice(): ?float
    {
        return $this->Rent_price;
    }

    public function setRentPrice(float $Rent_price): self
    {
        $this->Rent_price = $Rent_price;

        return $this;
    }

    public function getSecurityDepositPrice(): ?float
    {
        return $this->Security_deposit_price;
    }

    public function setSecurityDepositPrice(float $Security_deposit_price): self
    {
        $this->Security_deposit_price = $Security_deposit_price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getTenant(): ?Tenant
    {
        return $this->tenant;
    }

    public function setTenant(?Tenant $tenant): self
    {
        $this->tenant = $tenant;

        return $this;
    }
}
