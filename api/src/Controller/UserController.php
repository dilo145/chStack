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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/api/user')]
class UserController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/findUserById', name: 'find_user_by_id', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findOneBy(['id' => 1]);
        return $this->json($users);
    }

    #[Route('/new', name: 'api_user_new', methods: ['POST'])]
    public function newUser(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['firstName']) || !isset($data['lastName']) || !isset($data['email']) || !isset($data['photo'])) {
            return new JsonResponse(['error' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        }

        if (!preg_match("/^\S+@\S+\.\S+$/", $data['email'])) {
            return new JsonResponse(['error' => 'Invalid email format'], Response::HTTP_BAD_REQUEST);
        }

        if ($this->entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']])) {
            return new JsonResponse(['error' => 'Email already exists'], Response::HTTP_CONFLICT);
        }

        $user = new User();
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setEmail($data['email']);
        $user->setPhoto($data['photo']);
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $data['password']
            )
        );
        $user->setCreatedAt();

        // try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        // } catch (\Exception $e) {
        //     return new JsonResponse(['error' => 'Failed to save the user'], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }

        return new JsonResponse(['message' => 'User created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): JsonResponse
    {
        return new JsonResponse(['User' => $user]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['POST'])]
    public function edit(Request $request, User $user): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        if (isset($data['firstName'])) {
            $user->setFirstName($data['firstName']);
        }
        if (isset($data['lastName'])) {
            $user->setLastName($data['lastName']);
        }
        if (isset($data['email']) && preg_match("/^\S+@\S+\.\S+$/", $data['email'])) {
            $user->setEmail($data['email']);
        }
        if (isset($data['photo'])) {
            $user->setPhoto($data['photo']);
        }
        $user->setUpdatedAt();

        try {
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to edit user'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['Message' => 'User edited successfully'], Response::HTTP_OK);
    }

    #[Route('/{id}/delete', name: 'app_user_delete', methods: ['POST'])]
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
}
