<?php
namespace App\Controller;

use App\Service\QuestionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


#[Route('/api/questions')]
class QuestionController extends AbstractController
{
    private $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    #[Route('/new', name: 'api_question_new', methods: ['POST'])]
    public function newQuestion(Request $request): Response
    {
        return $this->questionService->create($request);
    }

    #[Route('/', name: 'api_question_read_all', methods: ['GET'])]
    public function readAllQuestions(): Response
    {
        return $this->questionService->readAll();
    }

    #[Route('/{id}', name: 'api_question_read', methods: ['GET'])]
    public function readQuestion(int $id): Response
    {
        return $this->questionService->read($id);
    }

    #[Route('/edit/{id}', name: 'api_question_edit', methods: ['PATCH'])]
    public function update(Request $request, int $id): Response
    {
        return $this->questionService->update($request, $id);
    }

    #[Route('/delete/{id}', name: 'api_question_delete', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        return $this->questionService->delete($id);
    }
}
?>