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

    public function legal(): void
    {
        $this->render("pages/legal.phtml", [
            "title" => "Mentions légales",
            "description" => "Mentions légales du site OneMoreRep."
        ]);
    }
}
