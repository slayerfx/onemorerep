<?php

class AuthController extends AbstractController
{
    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function login(): void
    {
        $this->render("pages/auth/login.phtml", [
            "title" => "Connexion",
            "description" => "Connecte-toi à ton compte OneMoreRep."
        ]);
    }

    public function checkLogin(): void
    {
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("login");
        }

        $email = $_POST["email"];
        $user = $this->userManager->findByEmail($email);

        if (!$user) {
            $_SESSION["error-message"] = "Email ou mot de passe incorrect.";
            $this->redirect("login");
        }

        $password = $_POST["password"];
        if (!password_verify($password, $user->getPassword())) {
            $_SESSION["error-message"] = "Email ou mot de passe incorrect.";
            $this->redirect("login");
        }

        $_SESSION["user"] = $user;
        $this->redirect("home");
    }

    public function register(): void
    {
        $this->render("pages/auth/register.phtml", [
            "title" => "Inscription",
            "description" => "Crée ton compte OneMoreRep gratuitement."
        ]);
    }

    public function checkRegister(): void
    {
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("register");
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];

        if ($password !== $confirmPassword) {
            $_SESSION["error-message"] = "Les mots de passe ne correspondent pas.";
            $this->redirect("register");
        }

        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
            $_SESSION["error-message"] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
            $this->redirect("register");
        }

        $existingUser = $this->userManager->findByEmail($email);

        if ($existingUser) {
            $_SESSION["error-message"] = "Cet email est déjà utilisé.";
            $this->redirect("register");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($email, $hashedPassword);
        $this->userManager->create($user);

        $_SESSION["user"] = $user;
        $this->redirect("home");
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect("home");
    }
}
