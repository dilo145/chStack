<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TrainingController extends AbstractController
{
    #[Route('/api/training', name: 'training_show', methods: ['GET'])]
    public function show(TrainingRepository $trainingRepository): Response
    {
        $training = $trainingRepository->findOneBy([], ['id' => 'DESC']);

        if (!$training) {
            throw $this->createNotFoundException('User not found');
        }

        return $this->json($training);
    }
}