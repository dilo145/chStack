<?php

namespace App\Controller;

use App\Repository\FormerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/formers')]
class FormerController
{
    #[Route('/new', name: 'former_create', methods: ['POST'])]
    public function create(Request $request,FormerRepository $formerRepository): Response
    {
        $data = json_decode($request->getContent(), true);

        $response = $formerRepository->create($data);

        return $this->json($response);
    }

}