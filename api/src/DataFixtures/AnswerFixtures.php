<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;

class AnswerFixtures extends Fixture
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $question = $this->entityManager->getRepository(Answer::class)->find($faker->numberBetween(1, 20));
        $student = $this->entityManager->getRepository(Student::class)->find($faker->numberBetween(1, 20));

        for ($i = 0; $i < 20; $i++) {
            $answer = new Answer();
            $answer
                ->setAnswer($faker->words(5, true))
                ->setQuestion($question)
                ->setStudent($student);
            $manager->persist($answer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StudentFixtures::class,
            QuestionFixtures::class
        ];
    }
}