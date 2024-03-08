<?php

namespace App\DataFixtures;

use App\Entity\Exam;
use App\Entity\Lesson;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ExamFixtures extends Fixture implements DependentFixtureInterface
{
            
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        $lesson = $this->entityManager->getRepository(Lesson::class)->find($faker->numberBetween(1, 10));

        for ($i = 0; $i < 1; $i++) {
            $exam = new Exam();
            $exam
                ->setGrade($faker->randomFloat(2, 0, 20))
                ->setLesson($lesson);
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