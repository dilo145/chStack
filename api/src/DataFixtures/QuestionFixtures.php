<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Exam;
use Doctrine\ORM\EntityManagerInterface;

class QuestionFixtures extends Fixture
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $exam = $this->entityManager->getRepository(Exam::class)->find($faker->numberBetween(1, 20));
        $answerQuestion = $this->entityManager->getRepository(Answer::class)->find($faker->numberBetween(1, 20));

        for ($i = 0; $i < 20; $i++) {
            $question = new Question();
            $question
                ->setQuestion($faker->label())
                ->setAnswer($faker->label())
                ->setExam($faker->label($exam))
                ->setAnswerQuestion($faker->label($answerQuestion));
            $manager->persist($question);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ExamFixtures::class
        ];
    }
}