<?php

class ExerciseController extends AbstractController
{
    private ExerciseManager $exerciseManager;

    public function __construct()
    {
        $this->exerciseManager = new ExerciseManager();
    }

    public function index(): void
    {
        $exercises = $this->exerciseManager->findAll();

        $this->render("pages/exercises/list.phtml", [
            "exercises" => $exercises,
            "title" => "Bibliothèque d'exercices",
            "description" => "26 exercices de musculation classés par groupe musculaire avec filtrage interactif et badges de difficulté."
        ]);
    }

    public function show(int $id): void
    {
        $exercise = $this->exerciseManager->findOne($id);

        if (!$exercise) {
            $this->redirect("exercises");
        }

        $this->render("pages/exercises/show.phtml", [
            "exercise" => $exercise,
            "title" => $exercise->getName(),
            "description" => $exercise->getName() . " - Exercice " . $exercise->getDifficulty() . " pour les " . $exercise->getMuscleGroup()->getName() . "."
        ]);
    }

    public function api(): void
    {
        $group = isset($_GET["group"]) ? (int) $_GET["group"] : null;

        if ($group) {
            $exercises = $this->exerciseManager->findByGroup($group);
        } else {
            $exercises = $this->exerciseManager->findAll();
        }

        $result = [];
        foreach ($exercises as $exercise) {
            $result[] = [
                "id" => $exercise->getId(),
                "name" => $exercise->getName(),
                "difficulty" => $exercise->getDifficulty(),
                "image" => $exercise->getImage(),
                "muscleGroup" => $exercise->getMuscleGroup()->getName()
            ];
        }

        header("Content-Type: application/json");
        echo json_encode($result);
    }
}
