<?php

class TDEECalculator
{
    // Mifflin-St Jeor formula: 
    public function calculateBmr(string $sex, int $age, float $weight, float $height): float
    {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age);

        if ($sex === "homme") {
            $bmr += 5;
        } else {
            $bmr -= 161;
        }

        return $bmr;
    }

    public function calculateTdee(float $bmr, float $activityFactor): float
    {
        return $bmr * $activityFactor;
    }
}
