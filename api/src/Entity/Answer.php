<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $answer = null;

    #[ORM\OneToOne(mappedBy: 'answerQuestion', cascade: ['persist', 'remove'])]
    private ?Question $question = null;

    #[ORM\ManyToOne(inversedBy: 'answer')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Student $student = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(?string $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): static
    {
        // unset the owning side of the relation if necessary
        if ($question === null && $this->question !== null) {
            $this->question->setAnswerQuestion(null);
        }

        // set the owning side of the relation if necessary
        if ($question !== null && $question->getAnswerQuestion() !== $this) {
            $question->setAnswerQuestion($this);
        }

        $this->question = $question;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): static
    {
        $this->student = $student;

        return $this;
    }
}
