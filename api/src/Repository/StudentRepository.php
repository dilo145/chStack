<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Student>
 *
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

//    /**
//     * @return Student[] Returns an array of Student objects
//     */
   public function findBytraining(int $id): array
   {
       return $this->createQueryBuilder('s')
        ->select('s.firstName', 's.lastName', 's.email', 's.id') // Selecting specific fields
        ->innerJoin('App\Entity\Registration', 'r', 'WITH', 'r.student = s.id') // Joining with the Registration entity using the student ID
        ->andWhere('r.training = :training_id') // Filtering by training_id
        ->setParameter('training_id', $id)
        ->getQuery()
        ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Student
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
