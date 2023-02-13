<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Property;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Tenant;

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
        for ($i = 1; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email())
                ->setRoles(['ROLE_ADMIN'])
                ->setPlainPassword('password');


            $manager->persist($user);
        }


        // Property
        $properties = [];
        for ($j = 1; $j < 30; $j++) {
            $property = new Property();
            $property->setTitle($this->faker->word())
                ->setDescription($this->faker->word())
                ->setSurface(mt_rand(10, 400))
                ->setRooms(mt_rand(2, 10))
                ->setBedrooms(mt_rand(1, 5))
                ->setAddress($this->faker->address())
                ->setAdditionalAddress(mt_rand(0, 1) === 1 ? $this->faker->address() : null)
                ->setCity($this->faker->city())
                ->setPostalCode(mt_rand(01000, 98000))
                ->setPriceCharges(mt_rand(40, 80))
                ->setRentPrice(mt_rand(300, 600))
                ->setSecurityDepositPrice(mt_rand(300, 600));

            $properties[] = $property;
            $manager->persist($property);
        }

        // Tenant
        for ($k = 1; $k < 20; $k++) {
            $tenant = new Tenant();
            $tenant->setName($this->faker->lastName())
                ->setFirstname($this->faker->firstName())
                ->setMonthlyRate(mt_rand(300, 1000))
                ->setAccountBalance(mt_rand(1000, 10000));

            for ($l = 0; $l < 1; $l++) {
                $tenant->addProperty($properties[mt_rand(0, count($properties) - 1)]);
            }


            $manager->persist($tenant);
        }


        $manager->flush();
    }
}
