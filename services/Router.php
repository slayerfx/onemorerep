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
            
            case "exercises":
                $controller = new ExerciseController();
                $controller->index();
                break;

            case "show-exercise":
                $controller = new ExerciseController();
                $controller->show($id);
                break;

            case "api-exercises":
                $controller = new ExerciseController();
                $controller->api();
                break;

            default:
                header("Location: index.php?route=home");
                break;
        }
    }
}
