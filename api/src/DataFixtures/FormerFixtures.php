<?php

namespace App\DataFixtures;

use App\Entity\Former;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;

class FormerFixtures extends Fixture
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 1; $i++) {
            $former = new Former();
            $former
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setEmail($faker->email())
                ->setPhoto($faker->imageUrl())
                ->setPassword($faker->password())
                ->setCreatedAt()
                ->setSpeciality($faker->randomLetter())
                ->setRoles(['ROLE_FORMER']);
            $manager->persist($former);
        }

        $manager->flush();
    }
}