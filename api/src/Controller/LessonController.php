<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\LessonRepository;
use App\Repository\LevelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/lessons')]
class LessonController extends AbstractController
{
    #[Route('/', name: 'lessons_show', methods: ['GET'])]
    public function getAll(LessonRepository $LessonRepository): Response
    {
        $lessons = $LessonRepository->findAll();

        return $this->json($lessons);
    }

    #[Route('/{id}', name: 'lesson_show', methods: ['GET'])]
    public function getOne(LessonRepository $LessonRepository, int $id): Response
    {
        $Lesson = $LessonRepository->find($id);

        if (!$Lesson) {
            throw $this->createNotFoundException('Lesson not found');
        }

        return $this->json($Lesson);
    }

    #[Route('/new', name: 'lesson_create', methods: ['POST'])]
    public function create(Request $request,  LessonRepository $LessonRepository, LevelRepository $LevelRepository, CategoriesRepository $CategoriesRepository): Response
    {
        $data = json_decode($request->getContent(), true);

        $level = $LevelRepository->find($data["level"]["id"]);
        $categories = $data["category"];

        if ($level == null || $categories == null) {
            throw $this->createNotFoundException('Error while accessing joined data');
        }

        $response = $LessonRepository->create($data, $level, $categories);

        if (!$response) {
            throw $this->createNotFoundException('Error while creating lesson');
        }

        return $this->json($response);
    }

    #[Route('/edit/{id}', name: 'lesson_update', methods: ['PUT'])]
    public function update(Request $request, LessonRepository $LessonRepository, int $id, LevelRepository $LevelRepository, CategoriesRepository $CategoriesRepository): Response
    {
        $data = json_decode($request->getContent(), true);

        $level = $LevelRepository->find($data["level"]["id"]);
    
        $categories = $data["category"];

        if ($level == null || $categories == null) {
            throw $this->createNotFoundException('Error while accessing joined data');
        }
        
        $response = $LessonRepository->update($data, $id, $level, $categories);

        if (!$response) {
            throw $this->createNotFoundException('Error while updating lesson');
        }

        return $this->json($response);
    }

    #[Route('/delete/{id}', name: 'lesson_delete', methods: ['DELETE'])]
    public function delete(LessonRepository $LessonRepository, int $id): Response
    {
        if ($id === null) {
            throw $this->createNotFoundException('Id is required');
        }

        $Lesson = $LessonRepository->delete($id);

        if (!$Lesson) {
            throw $this->createNotFoundException('Lesson not found');
        }

        return $this->json($Lesson);
    }
}
