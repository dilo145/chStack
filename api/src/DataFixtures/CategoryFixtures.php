<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $category = new Categories();
            $category
                ->setName($faker->firstName())
                ->setDescription($faker->words(7, true));
            $manager->persist($category);
        }

        $manager->flush();
    }
}