<?php

class CSRFTokenManager
{
    // Generate a random token and store it in session
    public function generateCSRFToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION["csrf_token"] = $token;

        return $token;
    }

    // Compare the submitted token with the one in session
    public function validateCSRFToken(string $token): bool
    {
        if (isset($_SESSION["csrf_token"]) && hash_equals($_SESSION["csrf_token"], $token)) {
            return true;
        }

        return false;
    }
}
