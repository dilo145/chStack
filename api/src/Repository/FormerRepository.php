<?php

namespace App\Repository;

use App\Entity\Former;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Former>
 *
 * @method Former|null find($id, $lockMode = null, $lockVersion = null)
 * @method Former|null findOneBy(array $criteria, array $orderBy = null)
 * @method Former[]    findAll()
 * @method Former[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormerRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(array $data): array
    {
        // Create a new Former instance
        $former = new Former();

        // Set inherited properties from User
        $former->setFirstName($data['firstName']);
        $former->setLastName($data['lastName']);
        $former->setEmail($data['email']);
        // Set the password, make sure to encode it
        $encodedPassword = $this->passwordEncoder->encodePassword($former, $data['password']);
        $former->setPassword($encodedPassword);
        $former->setSpeciality($data['speciality']);

        // Set the timestamps if necessary
        $former->setCreatedAt(); // This will set the current timestamp
        // $former->setUpdatedAt(); // You may not need to set this upon creation

        // Persist the former object
        $this->entityManager->persist($former);
        $this->entityManager->flush();

        // Return some kind of response data, typically the ID or the object itself
        return ['id' => $former->getId()];
    }
}
