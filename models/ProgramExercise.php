<?php

class ProgramExercise
{
    public function __construct(
        private Exercise $exercise,
        private int $sets,
        private int $reps,
        private int $restTime,
        private ?float $weight = null,
        private ?int $programId = null,
        private ?int $id = null
    )
    {
    }

    public function getExercise(): Exercise
    {
        return $this->exercise;
    }

    public function setExercise(Exercise $exercise): void
    {
        $this->exercise = $exercise;
    }

    public function getSets(): int
    {
        return $this->sets;
    }

    public function setSets(int $sets): void
    {
        $this->sets = $sets;
    }

    public function getReps(): int
    {
        return $this->reps;
    }

    public function setReps(int $reps): void
    {
        $this->reps = $reps;
    }

    public function getRestTime(): int
    {
        return $this->restTime;
    }

    public function setRestTime(int $restTime): void
    {
        $this->restTime = $restTime;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): void
    {
        $this->weight = $weight;
    }

    public function getProgramId(): ?int
    {
        return $this->programId;
    }

    public function setProgramId(?int $programId): void
    {
        $this->programId = $programId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}
