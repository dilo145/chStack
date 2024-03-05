<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\Column]
    private array $roles = [];
    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

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

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Student $student = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Former $former = null;

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
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTimeImmutable $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

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

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getFormer(): ?Former
    {
        return $this->former;
    }

    public function setFormer(?Former $former): static
    {
        $this->former = $former;

        return $this;
    }
}
