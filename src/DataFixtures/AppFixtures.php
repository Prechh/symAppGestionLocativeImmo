<?php

namespace App\DataFixtures;

use App\Entity\EtatDesLieux;
use App\Entity\Payments;
use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Property;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Tenant;
use Faker\Provider\ar_EG\Payment;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // User
        for ($i = 1; $i < 2; $i++) {
            $user = new User();
            $user->setEmail('email@AgenceWebFictive.com')
                ->setRoles(['ROLE_ADMIN'])
                ->setPlainPassword('password');


            $manager->persist($user);
        }


        $manager->flush();
    }
}
