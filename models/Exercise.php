<?php

class Exercise
{
    public function __construct(
        private string $name,
        private string $description,
        private string $difficulty,
        private MuscleGroup $muscleGroup,
        private ?string $image = null,
        private ?int $id = null
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): void
    {
        $this->difficulty = $difficulty;
    }

    public function getMuscleGroup(): MuscleGroup
    {
        return $this->muscleGroup;
    }

    public function setMuscleGroup(MuscleGroup $muscleGroup): void
    {
        $this->muscleGroup = $muscleGroup;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
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
