<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $student = new Student();
            $student
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setEmail($faker->email())
                ->setPhoto($faker->imageUrl())
                ->setPassword($faker->password())
                ->setCreatedAt()
                ->setInvidual($faker->boolean(30))
                ->setRoles(['ROLE_STUDENT']);
            $manager->persist($student);
        }

        $manager->flush();
    }
}