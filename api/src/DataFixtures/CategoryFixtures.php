<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends AppFixtures
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $level = new Categories();
            $level
                ->setName($faker->firstName())
                ->setDescription($faker->description());
            $manager->persist($level);
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