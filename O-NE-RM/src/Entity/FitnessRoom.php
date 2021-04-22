<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FitnessRoomRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FitnessRoomRepository::class)
 */
class FitnessRoom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("infos")
     * @Groups("listUsersFitnesstRoom")
     * @Groups("fitnessRoom_get")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("infos")
     * @Groups("fitnessRoom_get")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=400)
     * @Assert\Notblank
     * @Assert\Length(min=6)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="fitnessRoom")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setFitnessRoom($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getFitnessRoom() === $this) {
                $user->setFitnessRoom(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
 
}
