<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Property;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email())
                ->setRoles(['ROLE_ADMIN'])
                ->setPlainPassword('password');


            $manager->persist($user);
        }

        $manager->flush();


        for ($i = 1; $i < 10; $i++) {
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

            $manager->persist($property);
        }


        $manager->flush();
    }
}
