<?php

namespace App\Controller;

use App\Entity\Level;
use App\Repository\LevelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api/levels')]
class LevelController extends AbstractController
{
    #[Route('/', name: 'levels_show', methods: ['GET'])]
    public function getAll(LevelRepository $LevelRepository): Response
    {
        $levels = $LevelRepository->findAll();

        return $this->json($levels);
    }

    #[Route('/{id}', name: 'level_shows', methods: ['GET'])]
    public function getOne(LevelRepository $LevelRepository, int $id): Response
    {
        $level = $LevelRepository->find($id);

        if (!$level) {
            throw $this->createNotFoundException('Level not found');
        }

        return $this->json($level);
    }

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
}
