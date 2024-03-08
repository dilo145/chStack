<?php

namespace App\DataFixtures;

use App\Entity\Exam;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;

class ExamFixtures extends Fixture
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
            $exam = new Exam();
            $exam
                ->setGrade($faker->firstName());
            $manager->persist($exam);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            LessonFixtures::class
        ];
    }
}