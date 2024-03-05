<?php

namespace App\Repository;

use App\Entity\Lesson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lesson>
 *
 * @method Lesson|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lesson|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lesson[]    findAll()
 * @method Lesson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lesson::class);
    }

    public function getAll()
    {
        return $this->createQueryBuilder('l')
            ->select('l.id', 'l.title', 'l.description', 'l.place', 'l.time')
            ->getQuery()
            ->getResult();
    }

    public function getOne(int $id)
    {
        return $this->createQueryBuilder('l')
            ->select('l.id', 'l.title', 'l.description', 'l.videoUrl', 'l.createdAt')
            ->where('l.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function create($data)
    {
        $Lesson = new Lesson();
        $Lesson->setTitle($data['title']);
        $Lesson->setDescription($data['description']);

        $em = $this->getEntityManager();
        $em->persist($Lesson);
        $em->flush();

        return $Lesson;
    }

    public function update($data, int $id)
    {
        $Lesson = $this->find($id);

        if (!$Lesson) {
            return null;
        }

        $Lesson->setTitle($data['title']);
        $Lesson->setDescription($data['description']);

        $em = $this->getEntityManager();
        $em->persist($Lesson);
        $em->flush();

        return $Lesson;
    }

    public function delete(int $id)
    {
        $Lesson = $this->find($id);

        if (!$Lesson) {
            return null;
        }

        $em = $this->getEntityManager();
        $em->remove($Lesson);
        $em->flush();

        return $Lesson;
    }


}
