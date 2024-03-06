<?php

namespace App\Controller;

use App\Service\StudentService;
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
    
    #[Route('/{id}/edit', name: 'api_student_edit', methods: ['POST'])]
    public function editStudent(Request $request, int $id): JsonResponse
    {
        return $this->studentService->editStudent($request, $id);
    }
    
    #[Route('/{id}/delete', name: 'api_student_delete', methods: ['POST'])]
    public function deleteStudent(Request $request, int $id): JsonResponse
    {
        return $this->studentService->deleteStudent($request, $id);
    }
}
