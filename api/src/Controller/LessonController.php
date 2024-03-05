<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Repository\LessonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LessonController extends AbstractController
{
    #[Route('/api/get-lessons', name: 'lessons_show', methods: ['GET'])]
    public function getAll(LessonRepository $LessonRepository): Response
    {
        $lessons = $LessonRepository->findAll();

        if (!$lessons) {
            throw $this->createNotFoundException('Lessons not found');
        }

        return $this->json($lessons);
    }

    #[Route('/api/get-lesson/{id}', name: 'lesson_show', methods: ['GET'])]
    public function getOne(LessonRepository $LessonRepository, int $id): Response
    {
        $Lesson = $LessonRepository->find($id);

        if (!$Lesson) {
            throw $this->createNotFoundException('Lesson not found');
        }

        return $this->json($Lesson);
    }

    #[Route('/api/create-lesson', name: 'lesson_create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $Lesson = new Lesson();
        $Lesson->setTitle($data['title']);
        $Lesson->setDescription($data['description']);
        $Lesson->setVideoUrl($data['videoUrl']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($Lesson);
        $em->flush();

        return $this->json($Lesson);
    }

    #[Route('/api/update-lesson/{id}', name: 'lesson_update', methods: ['PUT'])]
    public function update(Request $request, LessonRepository $LessonRepository, int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        $Lesson = $LessonRepository->find($id);

        if (!$Lesson) {
            throw $this->createNotFoundException('Lesson not found');
        }

        $Lesson->setTitle($data['title']);
        $Lesson->setDescription($data['description']);
        $Lesson->setVideoUrl($data['videoUrl']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($Lesson);
        $em->flush();

        return $this->json($Lesson);
    }

    #[Route('/api/delete-lesson', name: 'lesson_delete', methods: ['DELETE'])]
    public function delete(LessonRepository $LessonRepository, int $id): Response
    {
        $Lesson = $LessonRepository->find($id);

        if (!$Lesson) {
            throw $this->createNotFoundException('Lesson not found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($Lesson);
        $em->flush();

        return $this->json(['message' => 'Lesson deleted']);
    }
}
