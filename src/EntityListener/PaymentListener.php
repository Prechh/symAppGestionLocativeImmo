<?php

// src/EventListener/PaymentListener.php

namespace App\EntityListener;

use App\Entity\Payments;
use App\Entity\Property;
use App\Entity\Tenant;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Faker\Provider\ar_EG\Payment;

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
      $deposit = $entity->getSecurityDepositPrice();
      $property = $entity->getTitle();

      $tenant->subtractDeposit($deposit);

      // Create new Payment entity
      $payment = new Payments();
      $payment->setAmount($deposit);
      $payment->setCreatedAt(new \DateTimeImmutable());
      $payment->setTenant($tenant);
      $payment->setProperty($property);
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
