<?php

namespace App\Repository;

use App\Entity\Training;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Training>
 *
 * @method Training|null find($id, $lockMode = null, $lockVersion = null)
 * @method Training|null findOneBy(array $criteria, array $orderBy = null)
 * @method Training[]    findAll()
 * @method Training[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Training::class);
    }

//    /**
//     * @return Training[] Returns an array of Training objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Training
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function getAll()
    {
        return $this->createQueryBuilder('t')
            ->select('t.id', 't.organism_id', 't.name', 't.goal_training')
            ->getQuery()
            ->getResult();
    }

    public function create($data, $organism)
    {
        $training = new Training();
        $training->setName($data['name']);
        $training->setGoalTraining($data['goal_training']);

        $training->setOrganism($organism);

        $em = $this->getEntityManager();
        $em->persist($training);
        $em->flush();

        return $training;
    }

    public function getOne(int $id)
    {
        return $this->createQueryBuilder('t')
            ->select('t.id', 't.organism_id', 't.name', 't.goal_training')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function update($data, int $id)
    {
        $training = $this->find($id);

        if (!$training) {
            return null;
        }

        $training->setName($data['name']);
        $training->setGoalTraining($data['goalTraining']);
        //$training->setOrganism($data['organism']);

        $em = $this->getEntityManager();
        $em->persist($training);
        $em->flush();

        return $training;
    }

    public function delete(int $id)
    {
        $training = $this->find($id);

        if (!$training) {
            return null;
        }

        $em = $this->getEntityManager();
        $em->remove($training);
        $em->flush();

        return $training;
    }
}
