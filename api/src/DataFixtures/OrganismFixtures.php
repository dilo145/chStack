<?php

namespace App\DataFixtures;

use App\Entity\Organism;
use App\Entity\Former;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;

class OrganismFixtures extends Fixture
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
            $formers = $this->entityManager->getRepository(Former::class)->findAll();
            $organism = new Organism();
            $organism
                ->setName($faker->firstName())
                ->setCreatedBy($formers[0]->getId());
            $manager->persist($organism);
        }

        $manager->flush();
    }

}