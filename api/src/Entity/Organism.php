<?php

namespace App\Entity;

use App\Repository\OrganismRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: OrganismRepository::class)]
class Organism
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[Ignore]
    #[ORM\OneToMany(targetEntity: Training::class, mappedBy: 'organism')]
    private Collection $training;

    #[ORM\Column]
    private ?int $createdBy = null;

    public function __construct()
    {
        $this->training = new ArrayCollection();
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getTraining(): Collection
    {
        return $this->training;
    }

    public function addTraining(Training $training): static
    {
        if (!$this->training->contains($training)) {
            $this->training->add($training);
            $training->setOrganism($this);
        }

        return $this;
    }

    public function removeTraining(Training $training): static
    {
        if ($this->training->removeElement($training)) {
            // set the owning side to null (unless already changed)
            if ($training->getOrganism() === $this) {
                $training->setOrganism(null);
            }
        }

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
