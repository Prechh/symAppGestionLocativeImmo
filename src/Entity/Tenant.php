<?php

namespace App\Entity;

use App\Repository\TenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity('name')]
#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: TenantRepository::class)]
class Tenant
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre nom est trop court. Il doit contenir au minimum 2 caractères',
        maxMessage: 'Votre nom est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre prénom est trop court. Il doit contenir au minimum 2 caractères',
        maxMessage: 'Votre prénom est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $firstname;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $monthly_rate = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $account_balance = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'tenant', targetEntity: Property::class)]
    private Collection $property;

    #[ORM\OneToMany(mappedBy: 'Tenant', targetEntity: Payments::class)]
    private Collection $payment;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $currentDateCol = null;

    #[ORM\OneToMany(mappedBy: 'Tenant', targetEntity: EtatDesLieux::class)]
    private Collection $etatDesLieux;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paymentType = "0";


    public function __construct()
    {
        $this->property = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->payment = new ArrayCollection();
        $this->etatDesLieux = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function setUpdatedAtVaue()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getMonthlyRate(): ?string
    {
        return $this->monthly_rate;
    }

    public function setMonthlyRate(string $monthly_rate): self
    {
        $this->monthly_rate = $monthly_rate;

        return $this;
    }

    public function getAccountBalance(): ?string
    {
        return $this->account_balance;
    }

    public function setAccountBalance(string $account_balance): self
    {
        $this->account_balance = $account_balance;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Property>
     */
    public function getProperty(): Collection
    {
        return $this->property;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->property->contains($property)) {
            $this->property->add($property);
            $property->setTenant($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->property->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getTenant() === $this) {
                $property->setTenant(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return Collection<int, Payments>
     */
    public function getPayment(): Collection
    {
        return $this->payment;
    }

    public function addPayment(Payments $payment): self
    {
        if (!$this->payment->contains($payment)) {
            $this->payment->add($payment);
            $payment->setTenant($this);
        }

        return $this;
    }

    public function removePayment(Payments $payment): self
    {
        if ($this->payment->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getTenant() === $this) {
                $payment->setTenant(null);
            }
        }

        return $this;
    }

    public function subtractRent($Rent_price)
    {
        $this->account_balance -= $Rent_price;
    }

    public function addMonthlyRate($monthly_rate)
    {
        $this->account_balance += $monthly_rate;
    }

    public function subtractRentx8($Rent_price)
    {
        $this->account_balance -= $Rent_price + ($Rent_price * 0.08);
    }

    public function subtractSecurityDeposit($Security_deposit_price)
    {
        $this->account_balance -= $Security_deposit_price;
    }

    public function subtractPriceCharges($Price_charges)
    {
        $this->account_balance -= $Price_charges;
    }

    public function subtractAll($Security_deposit_price, $Rent_price, $Price_charges)
    {
        $this->account_balance -= ($Security_deposit_price + $Rent_price + $Price_charges);
    }


    public function getCurrentDateCol(): ?\DateTimeInterface
    {
        return $this->currentDateCol;
    }

    public function setCurrentDateCol(?\DateTimeInterface $currentDateCol): self
    {
        $this->currentDateCol = $currentDateCol;

        return $this;
    }

    /**
     * @return Collection<int, EtatDesLieux>
     */
    public function getEtatDesLieux(): Collection
    {
        return $this->etatDesLieux;
    }

    public function addEtatDesLieux(EtatDesLieux $etatDesLieux): self
    {
        if (!$this->etatDesLieux->contains($etatDesLieux)) {
            $this->etatDesLieux->add($etatDesLieux);
            $etatDesLieux->setTenant($this);
        }

        return $this;
    }

    public function removeEtatDesLieux(EtatDesLieux $etatDesLieux): self
    {
        if ($this->etatDesLieux->removeElement($etatDesLieux)) {
            // set the owning side to null (unless already changed)
            if ($etatDesLieux->getTenant() === $this) {
                $etatDesLieux->setTenant(null);
            }
        }

        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }


    public function setPaymentType(?string $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }
}
