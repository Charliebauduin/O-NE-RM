<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use App\Repository\ExerciseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ExerciseRepository::class)
 */
class Exercise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("workout_get")
     * @Groups("progress_get")
     * @Groups("goals_get")
     * @Groups("progressUser")
     * @Groups("comment_get")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups("workout_get")
     * @Groups("progress_get")
     * @Groups("goals_get")
     * @Groups("progressUser")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups("workout_get")
     * @Groups("progress_get")
     * @Groups("goals_get")
     * @Groups("progressUser")
     * @Assert\NotBlank
     */
    private $difficulty;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("workout_get")
     * @Groups("progress_get")
     * @Groups("goals_get")
     * @Groups("progressUser")
     */
    private $illustration;

    /**
     * @ORM\Column(type="text")
     * @Groups("workout_get")
     * @Groups("progress_get")
     * @Groups("goals_get")
     * @Groups("progressUser")
     * @Assert\NotBlank
     */
    private $advice;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="exercise", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Progress::class, mappedBy="exercise", orphanRemoval=true)
     * @OrderBy({"date" = "DESC"})
     */
    private $progress;

    /**
     * @ORM\OneToMany(targetEntity=Goal::class, mappedBy="exercise", orphanRemoval=true)
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(?string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }

    public function getAdvice(): ?string
    {
        return $this->advice;
    }

    public function setAdvice(string $advice): self
    {
        $this->advice = $advice;

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
            $comment->setExercise($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getExercise() === $this) {
                $comment->setExercise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Progress[]
     */
    public function getProgress(): Collection
    {
        return $this->progress;
    }

    public function addProgress(Progress $progress): self
    {
        if (!$this->progress->contains($progress)) {
            $this->progress[] = $progress;
            $progress->setExercise($this);
        }

        return $this;
    }

    public function removeProgress(Progress $progress): self
    {
        if ($this->progress->removeElement($progress)) {
            // set the owning side to null (unless already changed)
            if ($progress->getExercise() === $this) {
                $progress->setExercise(null);
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
            $goal->setExercise($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): self
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getExercise() === $this) {
                $goal->setExercise(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

}
