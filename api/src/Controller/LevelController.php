<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\LevelService;
use Symfony\Component\HttpFoundation\Response;


#[Route('/api/levels')]
class LevelController extends AbstractController
{
    private $levelService;
    public function __construct(LevelService $levelService)
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
}