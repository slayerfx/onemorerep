<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../services/TDEECalculator.php";

class TDEECalculatorTest extends TestCase
{
    // Man: the formula adds +5 at the end
    public function testCalculateBmrForMan(): void
    {
        $calculator = new TDEECalculator();

        // (10 * 80) + (6.25 * 180) - (5 * 30) + 5 = 1780
        $bmr = $calculator->calculateBmr("homme", 30, 80, 180);

        $this->assertEquals(1780, $bmr);
    }

    // Woman: the formula subtracts 161 at the end
    public function testCalculateBmrForWoman(): void
    {
        $calculator = new TDEECalculator();

        // (10 * 65) + (6.25 * 168) - (5 * 28) - 161 = 1399
        $bmr = $calculator->calculateBmr("femme", 28, 65, 168);

        $this->assertEquals(1399, $bmr);
    }

    // TDEE is the BMR multiplied by the activity factor
    public function testCalculateTdee(): void
    {
        $calculator = new TDEECalculator();

        // 1399 * 1.55 (moderately active) = 2168.45
        $tdee = $calculator->calculateTdee(1399, 1.55);

        $this->assertEqualsWithDelta(2168.45, $tdee, 0.01);
    }
}
