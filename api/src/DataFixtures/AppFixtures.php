<?php

namespace App\DataFixtures;

use App\Entity\Former;
use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

use function PHPUnit\Framework\isEmpty;

class AppFixtures extends Fixture
{
  /**
   * @var Generator
   */
    private Generator $faker;

    public function __construct() 
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {

        // Former
        $formers = [];
        for ($i = 0; $i < 1; $i++) {
            $former = new Former();
            $former
                ->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName())
                ->setEmail($this->faker->email())
                ->setPhoto($this->faker->imageUrl())
                ->setPassword($this->faker->password())
                ->setCreatedAt()
                ->setSpeciality($this->faker->randomLetter())
                ->setRoles(['ROLE_FORMER']);
            $formers[] = $former;
            $manager->persist($former);
        }

        // $formersTemp = $formers;

        // Student
        $students = [];
        for ($i = 0; $i < 50; $i++) {
            $student = new Student();
            $student
                ->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName())
                ->setEmail($this->faker->email())
                ->setPhoto($this->faker->imageUrl())
                ->setPassword($this->faker->password())
                ->setCreatedAt()
                ->setInvidual($this->faker->boolean(30))
                ->setRoles(['ROLE_STUDENT']);
            $students[] = $student;
            $manager->persist($student);
        }

     $manager->flush();
    }
}