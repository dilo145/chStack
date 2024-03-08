<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/users')]
class UserController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findOneBy(['id' => 1]);
        return $this->json($users);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): JsonResponse
    {
        return new JsonResponse(['User' => $user]);
    }

    #[Route('/delete/{id}', name: 'app_user_delete', methods: ['DELETE'])]
    public function delete(Request $request, User $user): JsonResponse
    {
        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        // Check if CSRF token is valid (if you decide to use CSRF protection)
        // if (!$this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
        //     return new JsonResponse(['error' => 'Invalid CSRF token'], Response::HTTP_UNAUTHORIZED);
        // }

        $user->setDeletedAt(new \DateTime());

        try {
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to delete user'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['message' => 'User deleted successfully'], Response::HTTP_OK);
    }

    #[Route('/get_by_training/{id}', name: 'app_student_get_all_by_training', methods: ['GET'])]
    public function getAllStudentsByTraining(UserRepository $UserRepository, int $id): JsonResponse
    {
        $students = $UserRepository->findByuser($id);
        return $this->json($students);
    }
}
