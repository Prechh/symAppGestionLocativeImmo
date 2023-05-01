<?php
// src/Command/DeductionLoyerCommand.php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tenant;
use App\Entity\Property;
use App\Entity\Payments;
use Symfony\Component\Validator\Constraints\NotNull;

class RentDeductCommand extends Command
{
  // Nom de la commande
  protected static $defaultName = 'app:deduction-loyer';
  private $container;
  private $entityManager;


  public function __construct(ContainerInterface $container, EntityManagerInterface $entityManager)
  {
    parent::__construct();
    $this->container = $container;
    $this->entityManager = $entityManager;
  }

  protected function configure()
  {
    $this->setDescription('Déduit le loyer du solde du compte du Tenant rattaché à une propriété');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    // Get the EntityManager
    $entityManager = $this->container->get('doctrine')->getManager();

    // Get all Property with Tenant 
    $properties = $entityManager->createQueryBuilder()
      ->select('p')
      ->from('App\Entity\Property', 'p')
      ->where('p.tenant IS NOT NULL')
      ->getQuery()
      ->getResult();


    // Loop through properties and deduct rent
    foreach ($properties as $property) {
      $tenant = $property->getTenant();
      $propertyTitle = $property->getTitle();
      $propertyManage = $property->getManageType();
      $rentPrice = $property->getRentPrice();
      $monthly_rate = $tenant->getMonthlyRate();
      $Price_charges = $property->getPriceCharges();
      $rentPricex8 = $rentPrice + ($rentPrice * 0.08);


      if ($tenant) {

        if ($propertyManage === "Oui") {
          $tenant->subtractRentx8($rentPrice);
          $tenant->subtractPriceCharges($Price_charges);
          $tenant->addMonthlyRate($monthly_rate);


          // Create new Payment entity
          $payment = new Payments();
          $payment->setAmount($rentPrice + ($rentPrice * 0.08) + $Price_charges);
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

          $output->writeln('Deducted ' . $rentPricex8 . ' from tenant ' . $tenant->getName() . "'s balance");
          $output->writeln('Deducted ' . $Price_charges . ' from tenant ' . $tenant->getName() . "'s balance");
          $output->writeln('Add ' . $monthly_rate . ' from tenant ' . $tenant->getName() . "'s balance");
        }

        if ($propertyManage === "Non") {
          $tenant->subtractRent($rentPrice);
          $tenant->subtractPriceCharges($Price_charges);
          $tenant->addMonthlyRate($monthly_rate);

          // Create new Payment entity
          $payment = new Payments();
          $payment->setAmount($rentPrice + $Price_charges);
          $payment->setCreatedAt(new \DateTimeImmutable());
          $payment->setTenant($tenant);
          $payment->setProperty($propertyTitle);
          $payment->setInvoice('Facture' . $payment->getId());

          // Persist and flush new Payment entity
          $this->entityManager->persist($payment);
          $this->entityManager->persist($tenant);

          $output->writeln('Deducted ' . $rentPrice . ' from tenant ' . $tenant->getName() . "'s balance");
          $output->writeln('Deducted ' . $Price_charges . ' from tenant ' . $tenant->getName() . "'s balance");
          $output->writeln('Add ' . $monthly_rate . ' from tenant ' . $tenant->getName() . "'s balance");
        }
      } else {
        $output->writeln('No tenant found for property ' . $property->getTitle());
      }
      $this->entityManager->flush();
    }

    // Output a message indicating success
    $output->writeln('Rent deduction complete.');
    return Command::SUCCESS;
  }
}
