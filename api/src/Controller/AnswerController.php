<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\AnswerService;


#[Route('/api/answers')]
class AnswerController extends AbstractController
{
    private $answerService;

    public function __construct(AnswerService $answerService)
    {
        $this->answerService = $answerService;
    }

    #[Route('/new', name: 'api_answer_new', methods: ['POST'])]
    public function newAnswer(Request $request): Response
    {
        return $this->answerService->create($request);
    }

    #[Route('/', name: 'api_answer_read_all', methods: ['GET'])]
    public function readAllAnswers(): Response
    {
        return $this->answerService->readAll();
    }

    #[Route('/{id}', name: 'api_answer_read', methods: ['GET'])]
    public function readAnswer(int $id): Response
    {
        return $this->answerService->read($id);
    }

    #[Route('/edit/{id}', name: 'api_answer_edit', methods: ['POST'])]
    public function updateAnswer(Request $request, int $id): Response
    {
        return $this->answerService->update($request, $id);
    }

    #[Route('/delete/{id}', name: 'api_answer_delete', methods: ['DELETE'])]
    public function deleteAnswer(int $id): Response
    {
        return $this->answerService->delete($id);
    }
}
?>