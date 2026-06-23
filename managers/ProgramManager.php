<?php

class ProgramManager extends AbstractManager
{
    public function findByUser(int $userId): array
    {
        $query = $this->db->prepare(
            "SELECT id, user_id, name, created_at
             FROM programs
             WHERE user_id = :userId"
        );
        $query->execute(["userId" => $userId]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $programs = [];

        foreach ($results as $row) {
            $program = new Program(
                $row["name"],
                $row["user_id"],
                [],
                $row["created_at"],
                $row["id"]
            );

            $queryExercises = $this->db->prepare(
                "SELECT pe.id AS program_exercises_id, pe.sets, pe.reps, pe.weight, pe.rest_time,
                        e.id AS exercise_id, e.name, e.description, e.difficulty, e.image,
                        mg.id AS muscle_group_id, mg.name AS muscle_group_name
                 FROM program_exercises pe
                 JOIN exercises e ON pe.exercise_id = e.id
                 JOIN muscle_groups mg ON e.muscle_group_id = mg.id
                 WHERE pe.program_id = :programId"
            );
            $queryExercises->execute(["programId" => $row["id"]]);
            $resultsExercises = $queryExercises->fetchAll(PDO::FETCH_ASSOC);

            $programExercises = [];
            foreach ($resultsExercises as $row2) {
                $muscleGroup = new MuscleGroup($row2["muscle_group_name"], $row2["muscle_group_id"]);
                $exercise = new Exercise(
                    $row2["name"],
                    $row2["description"],
                    $row2["difficulty"],
                    $muscleGroup,
                    $row2["image"],
                    $row2["exercise_id"]
                );
                $programExercises[] = new ProgramExercise(
                    $exercise,
                    $row2["sets"],
                    $row2["reps"],
                    $row2["rest_time"],
                    $row2["weight"],
                    $row["id"],
                    $row2["program_exercises_id"]
                );
            }

            $program->setProgramExercises($programExercises);
            $programs[] = $program;
        }

        return $programs;
    }

    public function findOne(int $id): ?Program
    {
        $query = $this->db->prepare(
            "SELECT id, user_id, name, created_at
             FROM programs
             WHERE id = :id"
        );
        $query->execute(["id" => $id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $program = new Program(
            $row["name"],
            $row["user_id"],
            [],
            $row["created_at"],
            $row["id"]
        );

        $queryExercises = $this->db->prepare(
            "SELECT pe.id AS program_exercises_id, pe.sets, pe.reps, pe.weight, pe.rest_time,
                    e.id AS exercise_id, e.name, e.description, e.difficulty, e.image,
                    mg.id AS muscle_group_id, mg.name AS muscle_group_name
             FROM program_exercises pe
             JOIN exercises e ON pe.exercise_id = e.id
             JOIN muscle_groups mg ON e.muscle_group_id = mg.id
             WHERE pe.program_id = :programId"
        );
        $queryExercises->execute(["programId" => $row["id"]]);
        $resultsExercises = $queryExercises->fetchAll(PDO::FETCH_ASSOC);

        $programExercises = [];
        foreach ($resultsExercises as $row2) {
            $muscleGroup = new MuscleGroup($row2["muscle_group_name"], $row2["muscle_group_id"]);
            $exercise = new Exercise(
                $row2["name"],
                $row2["description"],
                $row2["difficulty"],
                $muscleGroup,
                $row2["image"],
                $row2["exercise_id"]
            );
            $programExercises[] = new ProgramExercise(
                $exercise,
                $row2["sets"],
                $row2["reps"],
                $row2["rest_time"],
                $row2["weight"],
                $row["id"],
                $row2["program_exercises_id"]
            );
        }

        $program->setProgramExercises($programExercises);
        return $program;
    }

    public function create(Program $program): void
    {
        $query = $this->db->prepare(
            "INSERT INTO programs (user_id, name)
             VALUES (:userId, :name)"
        );
        $query->execute([
            "userId" => $program->getUserId(),
            "name" => $program->getName()
        ]);

        $programId = $this->db->lastInsertId();

        foreach ($program->getProgramExercises() as $programExercise) {
            $queryExercise = $this->db->prepare(
                "INSERT INTO program_exercises (program_id, exercise_id, sets, reps, weight, rest_time)
                 VALUES (:programId, :exerciseId, :sets, :reps, :weight, :restTime)"
            );
            $queryExercise->execute([
                "programId" => $programId,
                "exerciseId" => $programExercise->getExercise()->getId(),
                "sets" => $programExercise->getSets(),
                "reps" => $programExercise->getReps(),
                "weight" => $programExercise->getWeight(),
                "restTime" => $programExercise->getRestTime()
            ]);
        }
    }

    public function update(Program $program): void
    {
        $query = $this->db->prepare(
            "UPDATE programs SET name = :name WHERE id = :id"
        );
        $query->execute([
            "name" => $program->getName(),
            "id" => $program->getId()
        ]);

        $queryDelete = $this->db->prepare(
            "DELETE FROM program_exercises WHERE program_id = :programId"
        );
        $queryDelete->execute(["programId" => $program->getId()]);

        foreach ($program->getProgramExercises() as $programExercise) {
            $queryExercise = $this->db->prepare(
                "INSERT INTO program_exercises (program_id, exercise_id, sets, reps, weight, rest_time)
                 VALUES (:programId, :exerciseId, :sets, :reps, :weight, :restTime)"
            );
            $queryExercise->execute([
                "programId" => $program->getId(),
                "exerciseId" => $programExercise->getExercise()->getId(),
                "sets" => $programExercise->getSets(),
                "reps" => $programExercise->getReps(),
                "weight" => $programExercise->getWeight(),
                "restTime" => $programExercise->getRestTime()
            ]);
        }
    }

    public function delete(int $id): void
    {
        $query = $this->db->prepare("DELETE FROM programs WHERE id = :id");
        $query->execute(["id" => $id]);
    }
}
