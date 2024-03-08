<?php

namespace App\Controller;

use App\Service\ResourceService;
use App\Repository\ResourceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api/ressources')]
class ResourceController extends AbstractController
{
    private $ressourceService;

    public function __construct(ResourceService $ressourceService)
    {
        $this->ressourceService = $ressourceService;
    }

    #[Route('/{id}', name: 'app_resource_get_one', methods: ['GET'])]
    public function getOneResource(int $id): JsonResponse
    {
        return $this->ressourceService->getOneResource($id);
    }

    #[Route('/', name: 'app_resource_get_all', methods: ['GET'])]
    public function getAllResources(): JsonResponse
    {
        return $this->ressourceService->getAllResources();
    }

    #[Route('/lesson/{lessonId}', name: 'api_resource_get_by_lesson', methods: ['GET'])]
    public function getRessourcesForLesson(int $lessonId): JsonResponse
    {
        return $this->ressourceService->getRessourcesByLesson($lessonId);
    }

    #[Route('/new/{lessonId}', name: 'api_resource_new', methods: ['POST'])]
    public function newResource(Request $request, int $lessonId): JsonResponse
    {
        return $this->ressourceService->newResource($request, $lessonId);
    }

    #[Route('/edit/{id}', name: 'api_resource_edit', methods: ['PUT'])]
    public function editResource(Request $request, int $id): JsonResponse
    {
        return $this->ressourceService->editResource($request, $id);
    }

    #[Route('/delete/{id}', name: 'api_resource_delete', methods: ['DELETE'])]
    public function deleteResource(int $id): JsonResponse
    {
        return $this->ressourceService->deleteResource($id);
    }

}
