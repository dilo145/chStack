<?php

namespace App\Entity;

use App\Repository\FormerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormerRepository::class)]
class Former
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'former', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Organism::class, mappedBy: 'former')]
    private Collection $organisms;

    public function __construct()
    {
        $this->organisms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setFormer(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getFormer() !== $this) {
            $user->setFormer($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Organism>
     */
    public function getOrganisms(): Collection
    {
        return $this->organisms;
    }

    public function addOrganism(Organism $organism): static
    {
        if (!$this->organisms->contains($organism)) {
            $this->organisms->add($organism);
            $organism->addFormer($this);
        }

        return $this;
    }

    public function removeOrganism(Organism $organism): static
    {
        if ($this->organisms->removeElement($organism)) {
            $organism->removeFormer($this);
        }

        return $this;
    }
}
