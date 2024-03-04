<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\Column(length: 255)]
    private ?string $answer = null;

    #[ORM\ManyToOne(inversedBy: 'question')]
    private ?Exam $exam = null;

    #[ORM\OneToOne(inversedBy: 'question', cascade: ['persist', 'remove'])]
    private ?Answer $answerQuestion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function getExam(): ?Exam
    {
        return $this->exam;
    }

    public function setExam(?Exam $exam): static
    {
        $this->exam = $exam;

        return $this;
    }

    public function getAnswerQuestion(): ?Answer
    {
        return $this->answerQuestion;
    }

    public function setAnswerQuestion(?Answer $answerQuestion): static
    {
        $this->answerQuestion = $answerQuestion;

        return $this;
    }
}
