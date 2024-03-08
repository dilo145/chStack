<?php

namespace App\DataFixtures;

use App\Entity\Former;
use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

use function PHPUnit\Framework\isEmpty;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            StudentFixtures::class,
            FormerFixtures::class,
            OrganismFixtures::class,
            LevelFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {

    }
}