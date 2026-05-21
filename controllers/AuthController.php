<?php

class AuthController extends AbstractController
{
    public function login(): void
    {
        $tokenManager = new CSRFTokenManager();
        $tokenManager->generateCSRFToken();

        $this->render("pages/auth/login.phtml", [
            "title" => "Connexion",
            "description" => "Connecte-toi à ton compte OneMoreRep."
        ]);
    }

    public function checkLogin(): void
    {
        // Step 1: Verify the CSRF token
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("login");
            return;
        }

        // Step 2: Get the email and search for the user in the database
        $email = $_POST["email"];
        $manager = new UserManager();
        $user = $manager->findByEmail($email);

        // Same error message whether email is wrong or password is wrong (prevents user enumeration)
        if (!$user) {
            $_SESSION["error-message"] = "Email ou mot de passe incorrect.";
            $this->redirect("login");
            return;
        }

        // Step 3: Verify the password with password_verify
        $password = $_POST["password"];
        if (!password_verify($password, $user->getPassword())) {
            $_SESSION["error-message"] = "Email ou mot de passe incorrect.";
            $this->redirect("login");
            return;
        }

        // Step 4: Store user in session and redirect
        $_SESSION["user"] = $user;
        $this->redirect("home");
    }

    public function register(): void
    {
        $tokenManager = new CSRFTokenManager();
        $tokenManager->generateCSRFToken();

        $this->render("pages/auth/register.phtml", [
            "title" => "Inscription",
            "description" => "Crée ton compte OneMoreRep gratuitement."
        ]);
    }

    public function checkRegister(): void
    {
        // Step 1: Verify the CSRF token
        $tokenManager = new CSRFTokenManager();
        if (!isset($_POST["csrf_token"]) || !$tokenManager->validateCSRFToken($_POST["csrf_token"])) {
            $this->redirect("register");
            return;
        }

        // Step 2: Get form data and check that passwords match
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];

        if ($password !== $confirmPassword) {
            $_SESSION["error-message"] = "Les mots de passe ne correspondent pas.";
            $this->redirect("register");
            return;
        }

        // Step 3: Validate strong password (min 8 chars, 1 uppercase, 1 lowercase, 1 digit, 1 special char)
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
            $_SESSION["error-message"] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
            $this->redirect("register");
            return;
        }

        // Step 4: Check that the email is not already used
        $manager = new UserManager();
        $existingUser = $manager->findByEmail($email);

        if ($existingUser) {
            $_SESSION["error-message"] = "Cet email est déjà utilisé.";
            $this->redirect("register");
            return;
        }

        // Step 5: Hash the password and create the user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($email, $hashedPassword);
        $manager->create($user);

        // Step 6: Fetch the created user (to get the id) and log them in
        $createdUser = $manager->findByEmail($email);
        $_SESSION["user"] = $createdUser;
        $this->redirect("home");
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect("home");
    }
}
