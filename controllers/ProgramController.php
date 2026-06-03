<?php

class ProgramController extends AbstractController
{
    private function isLoggedIn(): bool
    {
        return isset($_SESSION["user"]);
    }

    public function index(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
            return;
        }

        $programManager = new ProgramManager();
        $programs = $programManager->findByUser($_SESSION["user"]->getId());

        $this->render("pages/programs/index.phtml", [
            "title" => "Mes programmes",
            "description" => "Gérez vos programmes d'entraînement.",
            "programs" => $programs
        ]);
    }

    public function create(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
            return;
        }

        $exerciseManager = new ExerciseManager();

        $this->render("pages/programs/create.phtml", [
            "title" => "Créer un programme",
            "description" => "Créer un nouveau programme d'entraînement.",
            "exercises" => $exerciseManager->findAll()
        ]);
    }

    public function checkCreate(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
            return;
        }

        // Reject the request if the CSRF token is missing or invalid (CSRF protection)
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("programs");
            return;
        }

        $name = $_POST["name"];

        // Build one ProgramExercise per form row.
        // The Exercise only carries its id, which is all the manager needs for the pivot INSERT.
        $programExercises = [];

        foreach ($_POST["exercises"] as $exerciseData) {
            $muscleGroup = new MuscleGroup("", 0);
            $exerciseId = $exerciseData["exercise_id"];
            $exercise = new Exercise("", "", "", $muscleGroup, null, $exerciseId);

            $sets = $exerciseData["sets"];
            $reps = $exerciseData["reps"];
            $restTime = $exerciseData["rest_time"];

            $weight = null;
            if (!empty($exerciseData["weight"])) {
                $weight = $exerciseData["weight"];
            }

            $programExercises[] = new ProgramExercise($exercise, $sets, $reps, $restTime, $weight);
        }

        $program = new Program($name, $_SESSION["user"]->getId(), $programExercises);

        $programManager = new ProgramManager();
        $programManager->create($program);

        $this->redirect("programs");
    }

    public function edit(int $id): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
            return;
        }

        $programManager = new ProgramManager();
        $program = $programManager->findOne($id);

        // Check that the program exists and belongs to the user
        if (!$program || $program->getUserId() !== $_SESSION["user"]->getId()) {
            $this->redirect("programs");
            return;
        }

        $exerciseManager = new ExerciseManager();

        $this->render("pages/programs/edit.phtml", [
            "title" => "Modifier le programme",
            "description" => "Modifier un programme d'entraînement.",
            "program" => $program,
            "exercises" => $exerciseManager->findAll()
        ]);
    }

    public function checkEdit(int $id): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
            return;
        }

        // Reject the request if the CSRF token is missing or invalid (CSRF protection)
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("programs");
            return;
        }

        // Load the program and make sure it belongs to the current user
        $programManager = new ProgramManager();
        $program = $programManager->findOne($id);

        if (!$program || $program->getUserId() !== $_SESSION["user"]->getId()) {
            $this->redirect("programs");
            return;
        }

        // Build one ProgramExercise per form row.
        // The Exercise only carries its id, which is all the manager needs for the pivot INSERT.
        $programExercises = [];

        foreach ($_POST["exercises"] as $exerciseData) {
            $muscleGroup = new MuscleGroup("", 0);
            $exerciseId = $exerciseData["exercise_id"];
            $exercise = new Exercise("", "", "", $muscleGroup, null, $exerciseId);

            $sets = $exerciseData["sets"];
            $reps = $exerciseData["reps"];
            $restTime = $exerciseData["rest_time"];

            $weight = null;
            if (!empty($exerciseData["weight"])) {
                $weight = $exerciseData["weight"];
            }

            $programExercises[] = new ProgramExercise($exercise, $sets, $reps, $restTime, $weight);
        }

        $program->setName($_POST["name"]);
        $program->setProgramExercises($programExercises);

        $programManager->update($program);

        $this->redirect("programs");
    }

    public function delete(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
            return;
        }

        // Reject the request if the CSRF token is missing or invalid (CSRF protection)
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("programs");
            return;
        }

        // Load the program and make sure it belongs to the current user
        $id = $_POST["id"];
        $programManager = new ProgramManager();
        $program = $programManager->findOne($id);

        if (!$program || $program->getUserId() !== $_SESSION["user"]->getId()) {
            $this->redirect("programs");
            return;
        }

        $programManager->delete($id);

        $this->redirect("programs");
    }

}
