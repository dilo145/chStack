<?php

namespace App\Controller;

use App\Entity\Organism;
use App\Entity\Former;
use App\Repository\OrganismRepository;
use App\Repository\FormerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/organisms')]
class OrganismController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/new', name: 'api_organism_new', methods: ['POST'])]
    public function newOrganism(Request $request)
    {

        $organism = new Organism();
        $organism->setName("esgi");
        $organism->setLogo("path/to/logo.jpg");
        $organism->setCreatedBy(3);

        // try {
        $this->entityManager->persist($organism);
        $this->entityManager->flush();
        // } catch (\Exception $e) {
        //     return new JsonResponse(['error' => 'Failed to save the organism'], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }

        // // return new JsonResponse(['message' => 'Organism created successfully'], Response::HTTP_CREATED);
        return $this->json($organism);
    }

    #[Route('/by-Creator/{id}', name: 'api_organism_by_creator', methods: ['GET'])]
    public function getOrganismByCreator($id)
    {
        $organism = $this->entityManager->getRepository(Organism::class)->findBy(['createdBy' => $id]);
        return $this->json($organism);
    }
}
