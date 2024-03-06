<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "user_type", type: "string")]
#[ORM\DiscriminatorMap(["former" => "Former", "student" => "Student"])]
#[MappedSuperclass]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deletedAt = null;

    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'sender')]
    private Collection $messagesSended;

    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'reciver')]
    private Collection $messagesRecived;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    public function __construct()
    {
        $this->messagesSended = new ArrayCollection();
        $this->messagesRecived = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(): static
    {
        $this->createdAt = new \DateTimeImmutable();

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(): static
    {
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(): static
    {
        $this->deletedAt = new \DateTimeImmutable();

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessagesSended(): Collection
    {
        return $this->messagesSended;
    }

    public function addMessage(Message $messagesSended): static
    {
        if (!$this->messagesSended->contains($messagesSended)) {
            $this->messagesSended->add($messagesSended);
            $messagesSended->setSender($this);
        }

        return $this;
    }

    public function removeMessage(Message $messagesSended): static
    {
        if ($this->messagesSended->removeElement($messagesSended)) {
            // set the owning side to null (unless already changed)
            if ($messagesSended->getSender() === $this) {
                $messagesSended->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessagesRecived(): Collection
    {
        return $this->messagesRecived;
    }

    public function addMessagesRecived(Message $messagesRecived): static
    {
        if (!$this->messagesRecived->contains($messagesRecived)) {
            $this->messagesRecived->add($messagesRecived);
            $messagesRecived->setReciver($this);
        }

        return $this;
    }

    public function removeMessagesRecived(Message $messagesRecived): static
    {
        if ($this->messagesRecived->removeElement($messagesRecived)) {
            // set the owning side to null (unless already changed)
            if ($messagesRecived->getReciver() === $this) {
                $messagesRecived->setReciver(null);
            }
        }

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }
}
