<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("infos")
     * @Groups("progress_get")
     * @Groups("listUsersFitnesstRoom")
     * @Groups("comment_get")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("infos")
     * @Groups("listUsersFitnesstRoom")
     * @Assert\Email
     * @Assert\NotNull
     * @Assert\NotBlank
     * @Assert\Unique
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups("infos")
     * @Groups("listUsersFitnesstRoom")
     * @Assert\NotNull
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups("infos")
     * @Assert\Length(min=6)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups("infos")
     * @Groups("listUsersFitnesstRoom")
     * @Assert\NotNull
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("infos")
     * @Groups("progress_get")
     * @Groups("listUsersFitnesstRoom")
     * @Assert\NotNull
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=70)
     * @Groups("infos")
     * @Groups("progress_get")
     * @Groups("listUsersFitnesstRoom")
     * @Assert\NotNull
     */
    private $lastname;

    /**
     * @ORM\Column(type="integer")
     * @Groups("infos")
     * @Groups("listUsersFitnesstRoom")
     * @Assert\NotNull
     */
    private $age;

    /**
     * @ORM\ManyToOne(targetEntity=FitnessRoom::class, inversedBy="users")
     * @Groups("infos")
     * @Groups("listUsersFitnesstRoom")
     */
    private $fitnessRoom;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Progress::class, mappedBy="user", orphanRemoval=true)
     * @OrderBy({"date" = "DESC"})
     */
    private $progress;

    /**
     * @ORM\OneToMany(targetEntity=Goal::class, mappedBy="user", orphanRemoval=true)
     */
    private $goals;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->progress = new ArrayCollection();
        $this->goals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getFitnessRoom(): ?FitnessRoom
    {
        return $this->fitnessRoom;
    }

    public function setFitnessRoom(?FitnessRoom $fitnessRoom): self
    {
        $this->fitnessRoom = $fitnessRoom;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Progress[]
     * 
     */
    public function getProgress(): Collection
    {
        return $this->progress;
    }

    public function addProgress(Progress $progress): self
    {
        if (!$this->progress->contains($progress)) {
            $this->progress[] = $progress;
            $progress->setUser($this);
        }

        return $this;
    }

    public function removeProgress(Progress $progress): self
    {
        if ($this->progress->removeElement($progress)) {
            // set the owning side to null (unless already changed)
            if ($progress->getUser() === $this) {
                $progress->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Goal[]
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): self
    {
        if (!$this->goals->contains($goal)) {
            $this->goals[] = $goal;
            $goal->setUser($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): self
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getUser() === $this) {
                $goal->setUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->email;
    }


}
