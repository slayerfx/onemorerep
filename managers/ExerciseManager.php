<?php

class ExerciseManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare(
            "SELECT e.id, e.name, e.description, e.difficulty, e.image,
                    mg.id AS muscle_group_id, mg.name AS muscle_group_name
             FROM exercises e
             JOIN muscle_groups mg ON e.muscle_group_id = mg.id"
        );
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $exercises = [];
        foreach ($results as $row) {
            $muscleGroup = new MuscleGroup($row["muscle_group_name"], $row["muscle_group_id"]);
            $exercises[] = new Exercise(
                $row["name"],
                $row["description"],
                $row["difficulty"],
                $muscleGroup,
                $row["image"],
                $row["id"]
            );
        }

        return $exercises;
    }

    public function findOne(int $id): ?Exercise
    {
        $query = $this->db->prepare(
            "SELECT e.id, e.name, e.description, e.difficulty, e.image,
                    mg.id AS muscle_group_id, mg.name AS muscle_group_name
             FROM exercises e
             JOIN muscle_groups mg ON e.muscle_group_id = mg.id
             WHERE e.id = :id"
        );
        $query->execute(["id" => $id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $muscleGroup = new MuscleGroup($row["muscle_group_name"], $row["muscle_group_id"]);
        return new Exercise(
            $row["name"],
            $row["description"],
            $row["difficulty"],
            $muscleGroup,
            $row["image"],
            $row["id"]
        );
    }

    public function findByGroup(int $muscleGroupId): array
    {
        $query = $this->db->prepare(
            "SELECT e.id, e.name, e.description, e.difficulty, e.image,
                    mg.id AS muscle_group_id, mg.name AS muscle_group_name
             FROM exercises e
             JOIN muscle_groups mg ON e.muscle_group_id = mg.id
             WHERE e.muscle_group_id = :muscleGroupId"
        );
        $query->execute(["muscleGroupId" => $muscleGroupId]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $exercises = [];
        foreach ($results as $row) {
            $muscleGroup = new MuscleGroup($row["muscle_group_name"], $row["muscle_group_id"]);
            $exercises[] = new Exercise(
                $row["name"],
                $row["description"],
                $row["difficulty"],
                $muscleGroup,
                $row["image"],
                $row["id"]
            );
        }

        return $exercises;
    }
}
