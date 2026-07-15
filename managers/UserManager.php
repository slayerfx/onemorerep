<?php

class UserManager extends AbstractManager
{
    public function findByEmail(string $email): ?User
    {
        $query = $this->db->prepare(
            "SELECT *
             FROM users
             WHERE email = :email"
        );
        $query->execute(["email" => $email]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new User(
            $row["email"],
            $row["password"],
            $row["role"],
            $row["created_at"],
            $row["id"]
        );
    }

    public function create(User $user): void
    {
        $query = $this->db->prepare(
            "INSERT INTO users (email, password)
             VALUES (:email, :password)"
        );
        $query->execute([
            "email" => $user->getEmail(),
            "password" => $user->getPassword()
        ]);

        $user->setId($this->db->lastInsertId());
    }
}
