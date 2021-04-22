<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use App\Repository\ProgressRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProgressRepository::class)
 * 
 */
class Progress
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("progress_get")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("progress_get")
     * @Groups("progressUser")
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("progress_get")
     * @Groups("progressUser")
     */
    private $repetition;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("progress_get")
     * @Groups("progressUser")
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="progress")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("progress_get")
     * @Assert\NotNull
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Exercise::class, inversedBy="progress")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("progress_get")
     * @Groups("progressUser")
     * @Assert\NotNull
     * 
     */
    private $exercise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
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
