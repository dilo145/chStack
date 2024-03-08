<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use App\Entity\Resource;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ResourceFixtures extends Fixture
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

        for ($i = 0; $i < 20; $i++) {
            $resource = new Resource();
            $resource
                ->setName($faker->title())
                ->setDescription($faker->title())
                ->setCreatedAt();
                // ->setLesson($lesson)
            $manager->persist($resource);
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