<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $invidual = null;

    #[ORM\OneToOne(mappedBy: 'student', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: Registration::class, mappedBy: 'student')]
    private Collection $registrations;

    #[ORM\OneToMany(targetEntity: Answer::class, mappedBy: 'student')]
    private Collection $answer;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
        $this->answer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isInvidual(): ?bool
    {
        return $this->invidual;
    }

    public function setInvidual(bool $invidual): static
    {
        $this->invidual = $invidual;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setStudent(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getStudent() !== $this) {
            $user->setStudent($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Registration>
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): static
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations->add($registration);
            $registration->setStudent($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): static
    {
        if ($this->registrations->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getStudent() === $this) {
                $registration->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswer(): Collection
    {
        return $this->answer;
    }

    public function addAnswer(Answer $answer): static
    {
        if (!$this->answer->contains($answer)) {
            $this->answer->add($answer);
            $answer->setStudent($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): static
    {
        if ($this->answer->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getStudent() === $this) {
                $answer->setStudent(null);
            }
        }

        return $this;
    }
}
