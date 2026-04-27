<?php

class ExerciseController extends AbstractController
{
    public function index(): void
    {
        $manager = new ExerciseManager();
        $exercises = $manager->findAll();

        $this->render("pages/exercises/list.phtml", [
            "exercises" => $exercises,
            "title" => "Bibliothèque d'exercices",
            "description" => "26 exercices de musculation classés par groupe musculaire avec filtrage interactif et badges de difficulté."
        ]);
    }

    public function show(int $id): void
    {
        $manager = new ExerciseManager();
        $exercise = $manager->findOne($id);

        if (!$exercise) {
            $this->redirect("exercises");
        }

        $this->render("pages/exercises/show.phtml", [
            "exercise" => $exercise,
            "title" => $exercise->getName(),
            "description" => $exercise->getName() . " — " . $exercise->getMuscleGroup()->getName() . ", " . $exercise->getDifficulty() . ". " . substr($exercise->getDescription(), 0, 150)
        ]);
    }

    // Returns JSON data for the JS fetch filter (no HTML rendering)
    public function api(): void
    {
        $manager = new ExerciseManager();

        // Read the muscle group filter from the URL (?group=3)
        $group = isset($_GET["group"]) ? (int) $_GET["group"] : null;

        if ($group) {
            $exercises = $manager->findByGroup($group);
        } else {
            $exercises = $manager->findAll();
        }

        // Convert Exercise objects to associative array for json_encode
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

        // Send JSON response instead of rendering a template
        header("Content-Type: application/json");
        echo json_encode($result);
    }
}
