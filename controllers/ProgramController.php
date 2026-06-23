<?php

class ProgramController extends AbstractController
{
    private ProgramManager $programManager;
    private ExerciseManager $exerciseManager;

    public function __construct()
    {
        $this->programManager = new ProgramManager();
        $this->exerciseManager = new ExerciseManager();
    }

    public function index(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
        }

        $programs = $this->programManager->findByUser($_SESSION["user"]->getId());

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
        }

        $this->render("pages/programs/create.phtml", [
            "title" => "Créer un programme",
            "description" => "Créer un nouveau programme d'entraînement.",
            "exercises" => $this->exerciseManager->findAll()
        ]);
    }

    public function checkCreate(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
        }

        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("programs");
        }

        $name = $_POST["name"];

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

        $this->programManager->create($program);

        $this->redirect("programs");
    }

    public function edit(int $id): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
        }

        $program = $this->programManager->findOne($id);

        if (!$program || $program->getUserId() !== $_SESSION["user"]->getId()) {
            $this->redirect("programs");
        }

        $this->render("pages/programs/edit.phtml", [
            "title" => "Modifier le programme",
            "description" => "Modifier un programme d'entraînement.",
            "program" => $program,
            "exercises" => $this->exerciseManager->findAll()
        ]);
    }

    public function checkEdit(int $id): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
        }

        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("programs");
        }

        $program = $this->programManager->findOne($id);

        if (!$program || $program->getUserId() !== $_SESSION["user"]->getId()) {
            $this->redirect("programs");
        }

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

        $this->programManager->update($program);

        $this->redirect("programs");
    }

    public function delete(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
        }

        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("programs");
        }

        $id = $_POST["id"];
        $program = $this->programManager->findOne($id);

        if (!$program || $program->getUserId() !== $_SESSION["user"]->getId()) {
            $this->redirect("programs");
        }

        $this->programManager->delete($id);

        $this->redirect("programs");
    }

}
