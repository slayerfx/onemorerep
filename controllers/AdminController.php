<?php

class AdminController extends AbstractController
{
    private function isAdmin(): bool
    {
        return isset($_SESSION["user"]) && $_SESSION["user"]->getRole() === "admin";
    }

    public function index(): void
    {
        if (!$this->isAdmin()) {
            $this->redirect("login");
            return;
        }

        $exerciseManager = new ExerciseManager();
        $muscleGroupManager = new MuscleGroupManager();

        $this->render("pages/admin/exercises.phtml", [
            "title" => "Gestion des exercices",
            "description" => "Administration des exercices OneMoreRep.",
            "exercises" => $exerciseManager->findAll(),
            "muscleGroups" => $muscleGroupManager->findAll()
        ]);
    }

    public function create(): void
    {
        if (!$this->isAdmin()) {
            $this->redirect("login");
            return;
        }

        // Reject the request if the CSRF token is missing or invalid (CSRF protection)
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("admin-exercises");
            return;
        }

        $name = $_POST["name"];
        $description = $_POST["description"];
        $difficulty = $_POST["difficulty"];
        $muscleGroupId = $_POST["muscle_group_id"];
        $image = $_POST["image"];

        // Empty name because we only need the id for the database relation
        $muscleGroup = new MuscleGroup("", $muscleGroupId);
        $exercise = new Exercise($name, $description, $difficulty, $muscleGroup, $image);

        $manager = new ExerciseManager();
        $manager->create($exercise);

        $this->redirect("admin-exercises");
    }

    public function delete(): void
    {
        if (!$this->isAdmin()) {
            $this->redirect("login");
            return;
        }

        // Reject the request if the CSRF token is missing or invalid (CSRF protection)
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("admin-exercises");
            return;
        }

        $id = $_POST["id"];
        $manager = new ExerciseManager();
        $manager->delete($id);

        $this->redirect("admin-exercises");
    }
}
