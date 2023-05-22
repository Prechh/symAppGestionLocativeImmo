<?php

namespace App\Entity;

use App\Repository\EtatDesLieuxRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EtatDesLieuxRepository::class)]
class EtatDesLieux
{
    const PROPERTY = [
        'Appartement' => 'Appartement',
        'Maison' => 'Maison',
    ];

    const HEAT = [
        'Electrique' => 'Electrique',
        'Gaz' => 'Gaz'
    ];

    const HOTWATER = [
        'Electrique' => 'Electrique',
        'Gaz' => 'Gaz'
    ];


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $dateEnter = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $dateExit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $propertyType = null;

    #[ORM\Column(nullable: true)]
    private ?float $surface = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberMainRooms = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $fullAdress = null;
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre adresse est trop courte. Elle doit contenir au minimum 2 caractères',
        maxMessage: 'Votre adresse est trop longue. Elle doit contenir au maximum 50 caractères',
    )]

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre nom est trop court. Il doit contenir au minimum 2 caractères',
        maxMessage: 'Votre nom est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $fullnameLessor = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre adresse est trop courte. Elle doit contenir au minimum 2 caractères',
        maxMessage: 'Votre adresse est trop longue. Elle doit contenir au maximum 50 caractères',
    )]
    private ?string $fullAdressLessor = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre nom est trop court. Il doit contenir au minimum 2 caractères',
        maxMessage: 'Votre nom est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $fullnameTenant = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre adresse est trop courte. Elle doit contenir au minimum 2 caractères',
        maxMessage: 'Votre adresse est trop longue. Elle doit contenir au maximum 50 caractères',
    )]
    private ?string $fullAdressTenant = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberCounterElec = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberCounterGaz = null;

    #[ORM\Column(nullable: true)]
    private ?float $cubicMeterColdWater = null;

    #[ORM\Column(nullable: true)]
    private ?float $cubicMeterHotWater = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre nom est trop court. Il doit contenir au minimum 2 caractères',
        maxMessage: 'Votre nom est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $nameFormerTenant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $heatingType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $hotWaterType = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre valeur est trop courte. Elle doit contenir au minimum 2 caractères',
        maxMessage: 'Votre valeur est trop longue. Elle doit contenir au maximum 50 caractères',
    )]
    private ?string $stateBoiler = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberWaterRadiator = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberElecRadiator = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Votre valeur est trop courte. Elle doit contenir au minimum 2 caractères',
        maxMessage: 'Votre valeur est trop longue. Elle doit contenir au maximum 255 caractères',
    )]
    private ?string $observation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'etatDesLieux')]
    private ?Tenant $Tenant = null;

    #[ORM\OneToOne(cascade: ['remove'])]
    private ?Property $Property = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $propertyName = null;


    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEnter(): ?string
    {
        return $this->dateEnter;
    }

    public function setDateEnter(?string $dateEnter): self
    {
        $this->dateEnter = $dateEnter;

        return $this;
    }

    public function getDateExit(): ?string
    {
        return $this->dateExit;
    }

    public function setDateExit(?string $dateExit): self
    {
        $this->dateExit = $dateExit;

        return $this;
    }

    public function getPropertyType(): ?string
    {
        return $this->propertyType;
    }

    public function setPropertyType(?string $propertyType): self
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    public function getPropertyTypeType(): string
    {
        return self::PROPERTY[$this->propertyType];
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(?float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getNumberMainRooms(): ?int
    {
        return $this->numberMainRooms;
    }

    public function setNumberMainRooms(?int $numberMainRooms): self
    {
        $this->numberMainRooms = $numberMainRooms;

        return $this;
    }

    public function getFullAdress(): ?string
    {
        return $this->fullAdress;
    }

    public function setFullAdress(?string $fullAdress): self
    {
        $this->fullAdress = $fullAdress;

        return $this;
    }

    public function getFullnameLessor(): ?string
    {
        return $this->fullnameLessor;
    }

    public function setFullnameLessor(?string $fullnameLessor): self
    {
        $this->fullnameLessor = $fullnameLessor;

        return $this;
    }

    public function getFullAdressLessor(): ?string
    {
        return $this->fullAdressLessor;
    }

    public function setFullAdressLessor(?string $fullAdressLessor): self
    {
        $this->fullAdressLessor = $fullAdressLessor;

        return $this;
    }

    public function getFullnameTenant(): ?string
    {
        return $this->fullnameTenant;
    }

    public function setFullnameTenant(?string $fullnameTenant): self
    {
        $this->fullnameTenant = $fullnameTenant;

        return $this;
    }

    public function getFullAdressTenant(): ?string
    {
        return $this->fullAdressTenant;
    }

    public function setFullAdressTenant(?string $fullAdressTenant): self
    {
        $this->fullAdressTenant = $fullAdressTenant;

        return $this;
    }

    public function getNumberCounterElec(): ?int
    {
        return $this->numberCounterElec;
    }

    public function setNumberCounterElec(?int $numberCounterElec): self
    {
        $this->numberCounterElec = $numberCounterElec;

        return $this;
    }

    public function getNumberCounterGaz(): ?int
    {
        return $this->numberCounterGaz;
    }

    public function setNumberCounterGaz(?int $numberCounterGaz): self
    {
        $this->numberCounterGaz = $numberCounterGaz;

        return $this;
    }

    public function getCubicMeterColdWater(): ?float
    {
        return $this->cubicMeterColdWater;
    }

    public function setCubicMeterColdWater(?float $cubicMeterColdWater): self
    {
        $this->cubicMeterColdWater = $cubicMeterColdWater;

        return $this;
    }

    public function getCubicMeterHotWater(): ?float
    {
        return $this->cubicMeterHotWater;
    }

    public function setCubicMeterHotWater(?float $cubicMeterHotWater): self
    {
        $this->cubicMeterHotWater = $cubicMeterHotWater;

        return $this;
    }

    public function getNameFormerTenant(): ?string
    {
        return $this->nameFormerTenant;
    }

    public function setNameFormerTenant(?string $nameFormerTenant): self
    {
        $this->nameFormerTenant = $nameFormerTenant;

        return $this;
    }

    public function getHeatingType(): ?string
    {
        return $this->heatingType;
    }

    public function setHeatingType(?string $heatingType): self
    {
        $this->heatingType = $heatingType;

        return $this;
    }

    public function getHeatingTypeType(): string
    {
        return self::HEAT[$this->heatingType];
    }

    public function getHotWaterType(): ?string
    {
        return $this->hotWaterType;
    }

    public function setHotWaterType(?string $hotWaterType): self
    {
        $this->hotWaterType = $hotWaterType;

        return $this;
    }

    public function getHotWaterTypeType(): string
    {
        return self::HOTWATER[$this->hotWaterType];
    }

    public function getStateBoiler(): ?string
    {
        return $this->stateBoiler;
    }

    public function setStateBoiler(?string $stateBoiler): self
    {
        $this->stateBoiler = $stateBoiler;

        return $this;
    }

    public function getNumberWaterRadiator(): ?int
    {
        return $this->numberWaterRadiator;
    }

    public function setNumberWaterRadiator(?int $numberWaterRadiator): self
    {
        $this->numberWaterRadiator = $numberWaterRadiator;

        return $this;
    }

    public function getNumberElecRadiator(): ?int
    {
        return $this->numberElecRadiator;
    }

    public function setNumberElecRadiator(?int $numberElecRadiator): self
    {
        $this->numberElecRadiator = $numberElecRadiator;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getTenant(): ?Tenant
    {
        return $this->Tenant;
    }

    public function setTenant(?Tenant $Tenant): self
    {
        $this->Tenant = $Tenant;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->Property;
    }

    public function setProperty(?Property $Property): self
    {
        $this->Property = $Property;

        return $this;
    }

    public function getPropertyName(): ?string
    {
        return $this->propertyName;
    }

    public function setPropertyName(?string $propertyName): self
    {
        $this->propertyName = $propertyName;

        return $this;
    }
}
