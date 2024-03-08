<?php

namespace App\DataFixtures;

use App\Entity\Registration;
use App\Entity\Student;
use App\Entity\Training;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RegistrationFixtures extends Fixture implements DependentFixtureInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        $student = $this->entityManager->getRepository(Student::class)->find($faker->numberBetween(1, 50));
        $training = $this->entityManager->getRepository(Training::class)->find($faker->numberBetween(1, 20));

        for ($i = 0; $i < 10; $i++) {
            $registration = new Registration();
            $registration
                ->setStudent($student)
                ->setTraining($training)
                ->setCreatedAt();
            $manager->persist($registration);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StudentFixtures::class,
            TrainingFixtures::class,
        ];
    }
}