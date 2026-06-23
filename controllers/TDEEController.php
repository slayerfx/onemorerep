<?php

class TDEEController extends AbstractController
{
    public function index(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
        }

        $this->render("pages/tdee.phtml", [
            "title" => "Calculateur TDEE gratuit, OneMoreRep",
            "description" => "Calculez votre dépense énergétique journalière (TDEE) avec la formule Mifflin-St Jeor."
        ]);
    }

    public function calculate(): void
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("login");
        }

        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("tdee");
        }

        $sex = $_POST["sex"];
        $age = (int) $_POST["age"];
        $weight = (float) $_POST["weight"];
        $height = (float) $_POST["height"];
        $activityFactor = (float) $_POST["activity"];

        $calculator = new TDEECalculator();
        $bmr = $calculator->calculateBmr($sex, $age, $weight, $height);
        $tdee = $calculator->calculateTdee($bmr, $activityFactor);

        $this->render("pages/tdee.phtml", [
            "title" => "Calculateur TDEE gratuit, OneMoreRep",
            "description" => "Calculez votre dépense énergétique journalière (TDEE) avec la formule Mifflin-St Jeor.",
            "bmr" => $bmr,
            "tdee" => $tdee,
            "bulk" => $tdee * 1.1,
            "cut" => $tdee * 0.9
        ]);
    }
}
