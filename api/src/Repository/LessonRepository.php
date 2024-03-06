<?php

namespace App\Repository;

use App\Entity\Lesson;
use App\Entity\Categories;
use App\Entity\Level;
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

    public function create($data, $level)
    {
        $lesson = new Lesson();
        $lesson->setTitle($data['title']);
        $lesson->setDescription($data['description']);
        $lesson->setPlace($data['place']);
        $lesson->setGoal($data['goal']);

        $lesson->setLevel($level);
        // $lesson->setCategory($data['category']); TODO: implement after ig merge

        $em = $this->getEntityManager();
        $em->persist($lesson);
        $em->flush();

        return $lesson;
    }

    public function update($data, int $id)
    {
        $lesson = $this->find($id);

        if (!$lesson) {
            return null;
        }

        $lesson->setTitle($data['title']);
        $lesson->setDescription($data['description']);
        $lesson->setPlace($data['place']);
        $lesson->setGoal($data['goal']);

        $em = $this->getEntityManager();
        $em->persist($lesson);
        $em->flush();

        return $lesson;
    }

    public function delete(int $id)
    {
        $lesson = $this->find($id);

        if (!$lesson) {
            return null;
        }

        $em = $this->getEntityManager();
        $em->remove($lesson);
        $em->flush();

        return $lesson;
    }


}
