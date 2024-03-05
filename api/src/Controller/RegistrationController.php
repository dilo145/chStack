<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Security\LoginAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    #[Route('/api/register', name: 'app_register', methods: ['GET'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
    ): Response {
        $user = new User();

        // encode the plain password
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                "password"
            )
        );
        $user->setLastName("kjhdhf");
        $user->setFirstName("kjhdf");
        $user->setEmail("qsjkfh@gmail.com");
        $user->setRoles(['ROLE_USER']);
        $user->setPhoto("photo");
        $user->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Your account has been created.');

        return $this->json($user);
    }
}
