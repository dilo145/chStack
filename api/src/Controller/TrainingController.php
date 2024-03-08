<?php

namespace App\Controller;

use App\Entity\Training;
use App\Entity\Organism;
use App\Entity\Former;
use App\Repository\TrainingRepository;
use App\Repository\OrganismRepository;
use App\Repository\FormerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/trainings')]
class TrainingController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/new', name: 'api_training_new', methods: ['POST'])]
    public function newTraining(Request $request, TrainingRepository $TrainingRepository, OrganismRepository $OrganismRepository)
    {
        $data = json_decode($request->getContent(), true);

        $organism = $OrganismRepository->find($data["organism"]["id"]);

        if ($organism == null) {
            throw $this->createNotFoundException('Error while creating training');
        }

        $response = $TrainingRepository->create($data, $organism);

        if (!$response) {
            throw $this->createNotFoundException('Error while creating training');
        }

        return $this->json($response);
    }

    #[Route('/', name: 'app_training_index', methods: ['GET'])]
    public function getAll(TrainingRepository $TrainingRepository): Response
    {
        $trainings = $TrainingRepository->findAll();

        return $this->json($trainings);
    }

    #[Route('/update/{id}', name: 'training_update', methods: ['PUT'])]
    public function update(Request $request, TrainingRepository $TrainingRepository,OrganismRepository $OrganismRepository, int $id): Response
    {
        $data = json_decode($request->getContent(), true);
        $organism = $OrganismRepository->find($data["organism"]["id"]);
        $response = $TrainingRepository->update($data,$organism ,$id);
        if (!$response) {
            throw $this->createNotFoundException('Error while updating training');
        }

        return $this->json($response);
    }

    #[Route('/delete/{id}', name: 'training_delete', methods: ['DELETE'])]
    public function delete(TrainingRepository $TrainingRepository, int $id): Response
    {
        if ($id === null) {
            throw $this->createNotFoundException('Id is required');
        }

        $Training = $TrainingRepository->delete($id);

        if (!$Training) {
            throw $this->createNotFoundException('Training not found');
        }

        return $this->json($Training);
    }

    #[Route('/getOne/{id}', name: 'training_show', methods: ['GET'])]
    public function getOne(TrainingRepository $TrainingRepository, int $id): Response
    {
        $Training = $TrainingRepository->find($id);

        if (!$Training) {
            throw $this->createNotFoundException('Training not found');
        }

        return $this->json($Training);
    }
}
