<?php

namespace App\DataFixtures;

use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;

class LevelFixtures extends Fixture
{
            
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $level = new Level();
            $level
                ->setName($faker->firstName())
                ->setDescription($faker->description());
            $manager->persist($level);
        }

        $manager->flush();
    }
}