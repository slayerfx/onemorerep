<?php

class HomeController extends AbstractController
{
    public function index(): void
    {
        $this->render("pages/home.phtml", []);
    }
}
