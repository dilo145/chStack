<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/users', name: 'user_show', methods: ['GET'])]
    public function show(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy([], ['id' => 'DESC']);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        return $this->json($user);
    }
}
