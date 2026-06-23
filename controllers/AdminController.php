<?php

class AdminController extends AbstractController
{
    private ExerciseManager $exerciseManager;
    private MuscleGroupManager $muscleGroupManager;

    public function __construct()
    {
        $this->exerciseManager = new ExerciseManager();
        $this->muscleGroupManager = new MuscleGroupManager();
    }

    public function index(): void
    {
        if (!$this->isAdmin()) {
            $this->redirect("login");
        }

        $this->render("pages/admin/exercises.phtml", [
            "title" => "Gestion des exercices",
            "description" => "Administration des exercices OneMoreRep.",
            "exercises" => $this->exerciseManager->findAll(),
            "muscleGroups" => $this->muscleGroupManager->findAll()
        ]);
    }

    public function create(): void
    {
        if (!$this->isAdmin()) {
            $this->redirect("login");
        }

        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("admin-exercises");
        }

        $name = $_POST["name"];
        $description = $_POST["description"];
        $difficulty = $_POST["difficulty"];
        $muscleGroupId = $_POST["muscle_group_id"];
        $image = $_POST["image"];

        $muscleGroup = new MuscleGroup("", $muscleGroupId);
        $exercise = new Exercise($name, $description, $difficulty, $muscleGroup, $image);

        $this->exerciseManager->create($exercise);

        $this->redirect("admin-exercises");
    }

    public function delete(): void
    {
        if (!$this->isAdmin()) {
            $this->redirect("login");
        }

        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("admin-exercises");
        }

        $id = (int) $_POST["id"];
        $this->exerciseManager->delete($id);

        $this->redirect("admin-exercises");
    }
}
