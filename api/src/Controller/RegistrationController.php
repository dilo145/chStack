<?php
namespace App\Controller;

use App\Service\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api/registrations')]
class RegistrationController extends AbstractController
{
    private $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    #[Route('/new', name: 'api_registration_new', methods: ['POST'])]
    public function newRegistration(Request $request): Response
    {
        return $this->registrationService->create($request);
    }

    #[Route('/{id}', name: 'api_registration_read', methods: ['GET'])]
    public function readRegistration(int $id): Response
    {
        return $this->registrationService->read($id);
    }

    #[Route('/', name: 'api_registration_read_all', methods: ['GET'])]
    public function readAllRegistrations(): Response
    {
        return $this->registrationService->readAll();
    }

    #[Route('/edit/{id}', name: 'api_registration_edit', methods: ['PATCH'])]
    public function updateRegistration(Request $request, int $id): Response
    {
        return $this->registrationService->update($request, $id);
    }

    #[Route('/delete/{id}', name: 'api_registration_delete', methods: ['DELETE'])]
    public function deleteRegistration(int $id): Response
    {
        return $this->registrationService->delete($id);
    }
}
?>