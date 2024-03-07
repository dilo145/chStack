<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Lesson;
use App\Entity\Exam;

class ExamService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $lesson = $this->entityManager->getRepository(Lesson::class)->findOneById($data["lesson_id"]);
        
        if ($lesson == null) {
            throw new NotFoundHttpException('Error while creating exam: Lesson not found');
        }

        $exam = new Exam();
        $exam->setGrade($data['grade']);
        $exam->setLesson($lesson);

        try {
            $this->entityManager->persist($exam);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to create the exam'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Exam created successfully'], Response::HTTP_CREATED);
    }

    public function read(int $id): Response
    {
        $exam = $this->entityManager->getRepository(Exam::class)->findOneById($id);

        if ($exam == null) {
            throw new NotFoundHttpException('Error while reading exam: Exam not found');
        }

        $data = [
            'id' => $exam->getId(),
            'grade' => $exam->getGrade(),
            'lesson_id' => $exam->getLesson()->getId()
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function readAll(): Response
    {
        $exams = $this->entityManager->getRepository(Exam::class)->findAll();
        $data = [];

        foreach ($exams as $exam) {
            $data[] = [
                'id' => $exam->getId(),
                'grade' => $exam->getGrade(),
                'lesson_id' => $exam->getLesson()->getId()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
    
    public function update(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        $exam = $this->entityManager->getRepository(Exam::class)->findOneById($id);

        if ($exam == null) {
            throw new NotFoundHttpException('Error while updating exam: Exam not found');
        }

        $lesson = $this->entityManager->getRepository(Lesson::class)->findOneById($data["lesson_id"]);

        if ($lesson == null) {
            throw new NotFoundHttpException('Error while updating exam: Lesson not found');
        }

        if(isset($data['grade'])) {
            $exam->setGrade($data['grade']);
        }
        if(isset($lesson)) {
            $exam->setLesson($lesson);
        }

        try {
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to update the exam'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Exam updated successfully'], Response::HTTP_OK);
    }


    public function delete(int $id): Response
    {
        $exam = $this->entityManager->getRepository(Exam::class)->findOneById($id);

        if ($exam == null) {
            throw new NotFoundHttpException('Error while deleting exam: Exam not found');
        }

        try {
            $this->entityManager->remove($exam);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to delete the exam'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'Exam deleted successfully'], Response::HTTP_OK);
    }
}