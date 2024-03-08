<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use App\Entity\Level;
use App\Entity\Training;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categories;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LessonFixtures extends Fixture implements DependentFixtureInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        $training = $this->entityManager->getRepository(Training::class)->find($faker->numberBetween(1, 20));
        $category = $this->entityManager->getRepository(Categories::class)->find($faker->numberBetween(1, 3));
        $level = $this->entityManager->getRepository(Level::class)->find($faker->numberBetween(1, 20));
        // $resource = $this->entityManager->getRepository(Resource::class)->find($faker->numberBetween(1, 20));
        // $exam = $this->entityManager->getRepository(Exam::class)->find($faker->numberBetween(1, 20));

        for ($i = 0; $i < 10; $i++) {
            $lesson = new Lesson();
            $lesson
                ->setTitle($faker->title())
                ->setDescription($faker->words(7, true))
                ->setGoal($faker->words(5, true))
                ->setPlace($faker->words(12, true))
                ->addTraining($training)
                ->addCategory($category)
                ->setLevel($level);
                // ->addResource($resource)
                // ->addExam($exam);
            $manager->persist($lesson);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LevelFixtures::class,
            CategoryFixtures::class
        ];
    }
}