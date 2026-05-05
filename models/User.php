<?php

class User
{
    public function __construct(
        private string $email,
        private string $password,
        private string $role = "user",
        private ?int $tdee = null,
        private ?string $createdAt = null,
        private ?int $id = null
    )
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getTdee(): ?int
    {
        return $this->tdee;
    }

    public function setTdee(?int $tdee): void
    {
        $this->tdee = $tdee;
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
