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

            case "login":
                $controller = new AuthController();
                $controller->login();
                break;

            case "check-login":
                $controller = new AuthController();
                $controller->checkLogin();
                break;

            case "register":
                $controller = new AuthController();
                $controller->register();
                break;

            case "check-register":
                $controller = new AuthController();
                $controller->checkRegister();
                break;

            case "logout":
                $controller = new AuthController();
                $controller->logout();
                break;

            case "legal":
                $controller = new HomeController();
                $controller->legal();
                break;

            case "admin-exercises":
                $controller = new AdminController();
                $controller->index();
                break;

            case "admin-create-exercise":
                $controller = new AdminController();
                $controller->create();
                break;

            case "admin-delete-exercise":
                $controller = new AdminController();
                $controller->delete();
                break;

            case "programs":
                $controller = new ProgramController();
                $controller->index();
                break;

            case "create-program":
                $controller = new ProgramController();
                $controller->create();
                break;

            case "check-create-program":
                $controller = new ProgramController();
                $controller->checkCreate();
                break;

            case "edit-program":
                $controller = new ProgramController();
                $controller->edit($id);
                break;

            case "check-edit-program":
                $controller = new ProgramController();
                $controller->checkEdit($id);
                break;

            case "delete-program":
                $controller = new ProgramController();
                $controller->delete();
                break;

            case "tdee":
                $controller = new TDEEController();
                $controller->index();
                break;

            case "calculate-tdee":
                $controller = new TDEEController();
                $controller->calculate();
                break;

            default:
                header("Location: index.php?route=home");
                exit;
        }
    }
}
