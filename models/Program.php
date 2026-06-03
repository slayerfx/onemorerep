<?php

class Program
{
    public function __construct(
        private string $name,
        private int $userId,
        private array $programExercises = [],
        private ?string $createdAt = null,
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

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getProgramExercises(): array
    {
        return $this->programExercises;
    }

    public function setProgramExercises(array $programExercises): void
    {
        $this->programExercises = $programExercises;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
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
