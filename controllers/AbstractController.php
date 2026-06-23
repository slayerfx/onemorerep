<?php

abstract class AbstractController
{
    protected function render(string $template, array $data): void
    {
        require __DIR__ . "/../templates/layout.phtml";
    }

    protected function redirect(string $route): void
    {
        header("Location: index.php?route=" . $route);
        exit;
    }

    protected function isLoggedIn(): bool
    {
        return isset($_SESSION["user"]);
    }

    protected function isAdmin(): bool
    {
        return isset($_SESSION["user"]) && $_SESSION["user"]->getRole() === "admin";
    }
}
