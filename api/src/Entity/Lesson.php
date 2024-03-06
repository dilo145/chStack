<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
class Lesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $goal = null;

    #[ORM\Column(length: 255)]
    private ?string $place = null;

    #[ORM\ManyToMany(targetEntity: Training::class, mappedBy: 'lesson')]
    private Collection $trainings;

    #[ORM\OneToMany(targetEntity: Categories::class, mappedBy: 'lesson')]
    private Collection $category;

    #[ORM\ManyToOne(inversedBy: 'lessons', fetch: "EAGER")]
    private ?Level $level = null;

    #[ORM\OneToMany(targetEntity: Resource::class, mappedBy: 'lesson')]
    private Collection $resource;

    #[ORM\OneToMany(targetEntity: Exam::class, mappedBy: 'lesson')]
    private Collection $exam;

    public function __construct()
    {
        $this->trainings = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->resource = new ArrayCollection();
        $this->exam = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(?string $goal): static
    {
        $this->goal = $goal;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): static
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return Collection<int, Training>
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    public function addTraining(Training $training): static
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings->add($training);
            $training->addLesson($this);
        }

        return $this;
    }

    public function removeTraining(Training $training): static
    {
        if ($this->trainings->removeElement($training)) {
            $training->removeLesson($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Categories $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
            $category->setLesson($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): static
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getLesson() === $this) {
                $category->setLesson(null);
            }
        }

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): static
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection<int, Resource>
     */
    public function getResource(): Collection
    {
        return $this->resource;
    }

    public function addResource(Resource $resource): static
    {
        if (!$this->resource->contains($resource)) {
            $this->resource->add($resource);
            $resource->setLesson($this);
        }

        return $this;
    }

    public function removeResource(Resource $resource): static
    {
        if ($this->resource->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getLesson() === $this) {
                $resource->setLesson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exam>
     */
    public function getExam(): Collection
    {
        return $this->exam;
    }

    public function addExam(Exam $exam): static
    {
        if (!$this->exam->contains($exam)) {
            $this->exam->add($exam);
            $exam->setLesson($this);
        }

        return $this;
    }

    public function removeExam(Exam $exam): static
    {
        if ($this->exam->removeElement($exam)) {
            // set the owning side to null (unless already changed)
            if ($exam->getLesson() === $this) {
                $exam->setLesson(null);
            }
        }

        return $this;
    }
}
