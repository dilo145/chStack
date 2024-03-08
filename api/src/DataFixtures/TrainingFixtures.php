<?php

namespace App\DataFixtures;

use App\Entity\Organism;
use App\Entity\Training;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;

class TrainingFixtures extends Fixture
{
        
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $organism = $this->entityManager->getRepository(Organism::class)->find($faker->numberBetween(1, 20));

        for ($i = 0; $i < 20; $i++) {
            $training = new Training();
            $training
                ->setName($faker->firstName())
                ->setGoalTraining($faker->words(5, true))
                ->setOrganism($organism);
            $manager->persist($training);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OrganismFixtures::class
        ];
    }
}