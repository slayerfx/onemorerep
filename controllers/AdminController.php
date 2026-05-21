<?php

class AdminController extends AbstractController
{
    // Check if the user is logged in AND has the admin role
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

        $tokenManager = new CSRFTokenManager();
        $tokenManager->generateCSRFToken();

        $this->render("pages/admin/exercises.phtml", [
            "title" => "Gestion des exercices",
            "description" => "Administration des exercices OneMoreRep.",
            "exercises" => $exerciseManager->findAll(),
            "muscleGroups" => $muscleGroupManager->findAll()
        ]);
    }

    // Process the add exercise form
    public function create(): void
    {
        if (!$this->isAdmin()) {
            $this->redirect("login");
            return;
        }

        // Step 1: Verify the CSRF token
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("admin-exercises");
            return;
        }

        // Step 2: Get form data
        $name = $_POST["name"];
        $description = $_POST["description"];
        $difficulty = $_POST["difficulty"];
        $muscleGroupId = (int) $_POST["muscle_group_id"];
        $image = $_POST["image"];

        // Step 3: Create the Exercise object and save it
        // Empty name because we only need the id for the database relation
        $muscleGroup = new MuscleGroup("", $muscleGroupId);
        $exercise = new Exercise($name, $description, $difficulty, $muscleGroup, $image);

        $manager = new ExerciseManager();
        $manager->create($exercise);

        $this->redirect("admin-exercises");
    }

    // Delete an exercise
    public function delete(): void
    {
        if (!$this->isAdmin()) {
            $this->redirect("login");
            return;
        }

        // Step 1: Verify the CSRF token
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("admin-exercises");
            return;
        }

        // Step 2: Delete the exercise
        $id = (int) $_POST["id"];
        $manager = new ExerciseManager();
        $manager->delete($id);

        $this->redirect("admin-exercises");
    }
}
