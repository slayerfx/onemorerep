<?php

class Router
{
    public function handleRequest(): void
    {
        $route = isset($_GET["route"]) ? $_GET["route"] : "home";
        $id = isset($_GET["id"]) ? (int) $_GET["id"] : null;

        switch ($route) {
            case "home":
                $controller = new HomeController();
                $controller->index();
                break;

            default:
                header("Location: index.php?route=home");
                break;
        }
    }
}
