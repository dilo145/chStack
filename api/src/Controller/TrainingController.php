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
    public function newTraining(Request $request)
    {
        $organism = $this->entityManager->getRepository(Organism::class)->findOneBy(['id' => 3]);
        $former = $this->entityManager->getRepository(Former::class)->findOneBy(['id' => 3]);

        $training = new Training();
        $training->setName("ang");
        $training->setGoalTraining("var");
        $training->setOrganism($organism);
        $training->addFormer($former);

            $this->entityManager->persist($training);
            $this->entityManager->flush();
        return $this->json($training);
    }

    #[Route('/', name: 'app_training_index', methods: ['GET'])]
    public function index()
    {
        $trainings = $this->entityManager->getRepository(Training::class)->findAll();
        // dd($trainings);
        return $this->json($trainings);
        // return $this->json(null);
    }

}
