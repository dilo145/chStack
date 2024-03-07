<?php

namespace App\Controller;

use App\Service\StudentService;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/students')]
class StudentController extends AbstractController
{

    private $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    #[Route('/{id}', name: 'app_student_get_one', methods: ['GET'])]
    public function getOneStudent(int $id): JsonResponse
    {
        return $this->studentService->getOneStudent($id);
    }

    #[Route('/', name: 'app_student_get_all', methods: ['GET'])]
    public function getAllStudents(): JsonResponse
    {
        return $this->studentService->getAllStudents();
    }

    #[Route('/new', name: 'api_student_new', methods: ['POST'])]
    public function newStudent(Request $request): JsonResponse
    {
        return $this->studentService->newStudent($request);
    }

    #[Route('/edit/{id}', name: 'api_student_edit', methods: ['POST'])]
    public function editStudent(Request $request, int $id): JsonResponse
    {
        return $this->studentService->editStudent($request, $id);
    }

    #[Route('/delete/{id}', name: 'api_student_delete', methods: ['POST'])]
    public function deleteStudent(int $id): JsonResponse
    {
        return $this->studentService->deleteStudent($id);
    }

    #[Route('/get_by_training/{id}', name: 'app_student_get_all_by_training', methods: ['GET'])]
    public function getAllStudentsByTraining(StudentRepository $StudentRepository, int $id): JsonResponse
    {
        $students = $StudentRepository->findAllBytraining($id);
        return $this->json($students);
    }
}
