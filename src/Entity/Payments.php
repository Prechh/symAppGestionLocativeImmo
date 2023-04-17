<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PaymentsRepository;

#[ORM\Entity(repositoryClass: PaymentsRepository::class)]
class Payments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'payment')]
    private ?Tenant $Tenant = null;

    #[ORM\Column(length: 255)]
    private ?string $Invoice = null;

    #[ORM\Column(length: 255)]
    private ?string $Amount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Property = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getInvoice(): ?string
    {
        return $this->Invoice;
    }

    public function setInvoice(string $Invoice): self
    {
        $this->Invoice = $Invoice;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->Amount;
    }

    public function setAmount(string $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getProperty(): ?string
    {
        return $this->Property;
    }

    public function setProperty(?string $Property): self
    {
        $this->Property = $Property;

        return $this;
    }
}
