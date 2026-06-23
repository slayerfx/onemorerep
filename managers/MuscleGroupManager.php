<?php

class MuscleGroupManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT id, name FROM muscle_groups ORDER BY id");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $muscleGroups = [];
        foreach ($results as $row) {
            $muscleGroups[] = new MuscleGroup($row["name"], $row["id"]);
        }

        return $muscleGroups;
    }
}
