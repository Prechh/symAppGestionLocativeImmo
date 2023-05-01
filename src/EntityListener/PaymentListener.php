<?php

// src/EventListener/PaymentListener.php

namespace App\EntityListener;

use App\Entity\Payments;
use App\Entity\Property;
use DeepCopy\Matcher\PropertyMatcher;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;


class PaymentListener
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public function postUpdate(LifecycleEventArgs $args)
  {
    $entity = $args->getObject();

    if ($entity instanceof Property && $entity->getTenant() !== null) {
      $tenant = $entity->getTenant();
      $propertyTitle = $entity->getTitle();
      $propertyManage = $entity->getManageType();
      $Rent_price = $entity->getRentPrice();
      $Security_deposit_price = $entity->getSecurityDepositPrice();
      $Price_charges = $entity->getPriceCharges();

      if ($propertyManage === "Oui") {
        $tenant->subtractRentx8($Rent_price);
        $tenant->subtractSecurityDeposit($Security_deposit_price);
        $tenant->subtractPriceCharges($Price_charges);

        // Create new Payment entity
        $payment = new Payments();
        $payment->setAmount($Rent_price + ($Rent_price * 0.08) + $Security_deposit_price + $Price_charges);
        $payment->setCreatedAt(new \DateTimeImmutable());
        $payment->setTenant($tenant);
        $payment->setProperty($propertyTitle);
        $payment->setInvoice('Facture' . $payment->getId());


        // Persist and flush new Payment entity
        $this->entityManager->persist($payment);
        $this->entityManager->flush();


        // Update Tenant entity
        $this->entityManager->persist($tenant);
        $this->entityManager->flush();

        $payment->setInvoice('Facture' . $payment->getId());
      }
      if ($propertyManage === "Non") {
        $tenant->subtractAll($Security_deposit_price, $Rent_price, $Price_charges);

        // Create new Payment entity
        $payment = new Payments();
        $payment->setAmount($Rent_price + $Security_deposit_price + $Price_charges);
        $payment->setCreatedAt(new \DateTimeImmutable());
        $payment->setTenant($tenant);
        $payment->setProperty($propertyTitle);
        $payment->setInvoice('Facture' . $payment->getId());


        // Persist and flush new Payment entity
        $this->entityManager->persist($payment);
        $this->entityManager->flush();


        // Update Tenant entity
        $this->entityManager->persist($tenant);
        $this->entityManager->flush();

        $payment->setInvoice('Facture' . $payment->getId());
      }
    }
  }
}
