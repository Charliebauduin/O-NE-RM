<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GoalRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GoalRepository::class)
 */
class Goal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("goals_get")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("goals_get")
     */
    private $repetition;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("goals_get")
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="goals")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     * 
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Exercise::class, inversedBy="goals")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("goals_get")
     * @Assert\NotNull
     */
    private $exercise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRepetition(): ?int
    {
        return $this->repetition;
    }

    public function setRepetition(?int $repetition): self
    {
        $this->repetition = $repetition;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): self
    {
        $this->exercise = $exercise;

        return $this;
    }
}
