<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\FormerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: FormerRepository::class)]
class Former extends User
{

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $speciality = null;

    #[Ignore]
    #[ORM\ManyToMany(targetEntity: Training::class, inversedBy: 'formers')]
    private Collection $trainings;

    public function __construct()
    {
        $this->trainings = new ArrayCollection();
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(?string $speciality): static
    {
        $this->speciality = $speciality;

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
        }

        return $this;
    }

    public function removeTraining(Training $training): static
    {
        $this->trainings->removeElement($training);

        return $this;
    }
}
