<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\User;
use App\Repository\FormerRepository;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/students')]
class StudentController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_former_index', methods: ['GET'])]
    public function index(StudentRepository $studentRepository): Response
    {
        $student = $studentRepository->findAll();

        return $this->json($student);
    }

    #[Route('/new', name: 'api_student_new', methods: ['POST'])]
    public function newStudent(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $student = new Student();
        $student->setFirstName('firstName');
        $student->setLastName('lastName');
        $student->setEmail('email@emsail.com');
        $student->setPhoto('/path/to/photo.jpg');
        $student->setCreatedAt();
        $student->setInvidual(true);
        $student->setPassword('password');

        // try {
            $this->entityManager->persist($student);
            $this->entityManager->flush();
        // } catch (\Exception $e) {
        //     return new JsonResponse(['error' => 'Failed to save the student'], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }

        return new JsonResponse(['message' => 'User created successfully'], Response::HTTP_CREATED);
    }

    // #[Route('/{id}', name: 'app_former_show', methods: ['GET'])]
    // public function show(Former $former): JsonResponse
    // {
    //     return $this->json($former);
    // }
    
    // #[Route('/{id}/edit', name: 'app_user_edit', methods: ['POST'])]
    // public function edit(Request $request, User $user): JsonResponse
    // {
    //     $data = json_decode($request->getContent(), true);

    //     if (!$user) {
    //         return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
    //     }

    //     if (isset($data['firstName'])) {
    //         $user->setFirstName($data['firstName']);
    //     }
    //     if (isset($data['lastName'])) {
    //         $user->setLastName($data['lastName']);
    //     }
    //     if (isset($data['email']) && preg_match("/^\S+@\S+\.\S+$/", $data['email'])) {
    //         $user->setEmail($data['email']);
    //     }
    //     if (isset($data['photo'])) {
    //         $user->setPhoto($data['photo']);
    //     }
    //     $user->setUpdatedAt();

    //     try {
    //         $this->entityManager->flush();
    //     } catch (\Exception $e) {
    //         return new JsonResponse(['error' => 'Failed to edit user'], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }

    //     return new JsonResponse(['Message' => 'User edited successfully'], Response::HTTP_OK);
    // }

    // #[Route('/{id}/delete', name: 'app_user_delete', methods: ['POST'])]
    // public function delete(Request $request, User $user): JsonResponse
    // {
    //     if (!$user) {
    //         return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
    //     }

    //     // Check if CSRF token is valid (if you decide to use CSRF protection)
    //     // if (!$this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
    //     //     return new JsonResponse(['error' => 'Invalid CSRF token'], Response::HTTP_UNAUTHORIZED);
    //     // }

    //     $user->setDeletedAt(new \DateTime());

    //     try {
    //         $entityManager->flush();
    //     } catch (\Exception $e) {
    //         return new JsonResponse(['error' => 'Failed to delete user'], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }

    //     return new JsonResponse(['message' => 'User deleted successfully'], Response::HTTP_OK);
    // }
}
