<?php

class HomeController extends AbstractController
{
    public function index(): void
    {
        $this->render("pages/home.phtml", [
            "title" => "Accueil",
            "description" => "Bibliothèque d'exercices, programmes personnalisés et calculateur TDEE. Gratuit et sans abonnement."
        ]);
    }
}
