<?php

// src/EventListener/TenantListener.php

namespace App\EntityListener;

use App\Entity\Property;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TenantListener
{
  public function postUpdate(LifecycleEventArgs $args)
  {
    $entity = $args->getObject();

    if ($entity instanceof Property && $entity->getTenant() !== null) {
      $tenant = $entity->getTenant();
      $deposit = $entity->getSecurityDepositPrice();

      $tenant->subtractDeposit($deposit);

      $entityManager = $args->getObjectManager();
      $entityManager->persist($tenant);
      $entityManager->flush();
    }
  }
}
