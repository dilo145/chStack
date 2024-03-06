<?php

namespace App\Entity;

use App\Repository\TrainingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingRepository::class)]
class Training
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $goalTraining = null;

    #[ORM\ManyToOne(inversedBy: 'training', fetch: "EAGER")]
    private ?Organism $organism = null;

    #[ORM\OneToMany(targetEntity: Registration::class, mappedBy: 'training')]
    private Collection $registrations;

    #[ORM\ManyToMany(targetEntity: Lesson::class, inversedBy: 'trainings')]
    private Collection $lesson;

    #[ORM\ManyToMany(targetEntity: Former::class, mappedBy: 'trainings')]
    private Collection $formers;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
        $this->lesson = new ArrayCollection();
        $this->formers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getGoalTraining(): ?string
    {
        return $this->goalTraining;
    }

    public function setGoalTraining(?string $goalTraining): static
    {
        $this->goalTraining = $goalTraining;

        return $this;
    }

    
    public function getOrganism(): ?Organism
    {
        return $this->organism;
    }

    public function setOrganism(?Organism $organism): static
    {
        $this->organism = $organism;

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
            $registration->setTraining($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): static
    {
        if ($this->registrations->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getTraining() === $this) {
                $registration->setTraining(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getLesson(): Collection
    {
        return $this->lesson;
    }

    public function addLesson(Lesson $lesson): static
    {
        if (!$this->lesson->contains($lesson)) {
            $this->lesson->add($lesson);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): static
    {
        $this->lesson->removeElement($lesson);

        return $this;
    }

    /**
     * @return Collection<int, Former>
     */
    public function getFormers(): Collection
    {
        return $this->formers;
    }

    public function addFormer(Former $former): static
    {
        if (!$this->formers->contains($former)) {
            $this->formers->add($former);
            $former->addTraining($this);
        }

        return $this;
    }

    public function removeFormer(Former $former): static
    {
        if ($this->formers->removeElement($former)) {
            $former->removeTraining($this);
        }

        return $this;
    }
}
