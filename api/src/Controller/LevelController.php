<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\LevelService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;


#[Route('/api/levels')]
class LevelController extends AbstractController
{
    private $levelService;
    private $entityManager;
    public function __construct(LevelService $levelService, EntityManagerInterface $entityManager)
    {
        $this->levelService = $levelService;
    }

    #[Route('/new', name: 'api_level_new', methods: ['POST'])]
    public function newLevel(Request $request)
    {
        return $this->levelService->create($request);
    }

    #[Route('/edit/{id}', name: 'api_level_edit', methods: ['PATCH'])]
    public function updateLevel(Request $request, int $id): Response
    {
        return $this->levelService->update($request, $id);
    }

    #[Route('/delete/{id}', name: 'api_level_delete', methods: ['DELETE'])]
    public function deleteLevel(int $id): Response
    {
        return $this->levelService->delete($id);
    }

    #[Route('/{id}', name: 'api_level_read', methods: ['GET'])]
    public function readLevel(int $id): Response
    {
        return $this->levelService->read($id);
    }

    #[Route('/', name: 'api_level_read_all', methods: ['GET'])]
    public function readAllLevels(): Response
    {
        return $this->levelService->readAll();
    }
    // #[Route('/by-Creator/{id}', name: 'api_level_by_creator', methods: ['GET'])]
    // public function getOrganismByCreator($id)
    // {
    //     $organism = $this->entityManager->getRepository(Organism::class)->findBy(['createdBy' => $id]);
    //     return $this->json($organism);
    // }

    // #[Route('/', name: 'api_organism_read_all', methods: ['GET'])]
    // public function readAllOrganisms(): Response
    // {
    //     return $this->organismService->readAll();
    // }

    // #[Route('/{id}', name: 'api_organism_read', methods: ['GET'])]
    // public function readOrganism(int $id): Response
    // {
    //     return $this->organismService->read($id);
    // }



    // #[Route('/delete/{id}', name: 'api_organism_delete', methods: ['DELETE'])]
    // public function deleteOrganism(int $id): Response
    // {
    //     return $this->organismService->delete($id);
    }














    // #[Route('/', name: 'levels_show', methods: ['GET'])]
    // public function getAll(LevelRepository $LevelRepository): Response
    // {
    //     $levels = $LevelRepository->findAll();

    //     return $this->json($levels);
    // }

    // #[Route('/{id}', name: 'level_shows', methods: ['GET'])]
    // public function getOne(LevelRepository $LevelRepository, int $id): Response
    // {
    //     $level = $LevelRepository->find($id);

    //     if (!$level) {
    //         throw $this->createNotFoundException('Level not found');
    //     }

    //     return $this->json($level);
    // }

    // #[Route('/create-level', name: 'level_create', methods: ['POST'])]
    // public function create(Request $request,  LevelRepository $LevelRepository,): Response
    // {
    //     $data = json_decode($request->getContent(), true);

    //     $response = $LevelRepository->create($data);

    //     if (!$response) {
    //         throw $this->createNotFoundException('Error while creating lesson');
    //     }

    //     return $this->json($response);
    // }

    // #[Route('/update-level/{id}', name: 'level_update', methods: ['PUT'])]
    // public function update(Request $request, LevelRepository $LevelRepository, int $id): Response
    // {
    //     $data = json_decode($request->getContent(), true);

    //     $response = $LevelRepository->update($data, $id);

    //     if (!$response) {
    //         throw $this->createNotFoundException('Error while updating lesson');
    //     }

    //     return $this->json($response);
    // }

    // #[Route('/delete-level/{id}', name: 'level_delete', methods: ['DELETE'])]
    // public function delete(LevelRepository $LevelRepository, int $id): Response
    // {
    //     if ($id === null) {
    //         throw $this->createNotFoundException('Id is required');
    //     }

    //     $level = $LevelRepository->delete($id);

    //     if (!$level) {
    //         throw $this->createNotFoundException('Level not found');
    //     }

    //     return $this->json($level);
    // }
//}
