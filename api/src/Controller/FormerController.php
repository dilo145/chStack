<?php

namespace App\Controller;

use App\Entity\Former;
use App\Entity\User;
use App\Repository\FormerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/formers')]
class FormerController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // #[Route('/', name: 'app_former_index', methods: ['GET'])]
    // public function index(FormerRepository $formerRepository): Response
    // {
    //     $formers = $formerRepository->findAll();

    //     return $this->json($formers);
    // }

    #[Route('/new', name: 'api_former_new', methods: ['POST'])]
    public function newFormer(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // $user = $this->entityManager->getRepository(User::class)->find($data['userId']);
        // $user =$this->entityManager->getRepository(User::class)->findOneBy(['id' => $data['userId']]);

        $former = new Former();
        $former->setFirstName("teqs");
        $former->setLastName("redqs");
        $former->setEmail("sqdqs@sqd.com");
        $former->setPhoto("/path/to/photo.jpg");
        $former->setCreatedAt();
        $former->setPassword("password");
        // $former->addOrganism()

        try {
            $this->entityManager->persist($former);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to save the former'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // return new JsonResponse(['message' => 'User created successfully'], Response::HTTP_CREATED);
        return $this->json($former);
    }

    // #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    // public function show(User $user): JsonResponse
    // {
    //     return new JsonResponse(['User' => $user]);
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
