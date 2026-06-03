<?php

class CSRFTokenManager
{
    public function generateCSRFToken(): string
    {
        $token = bin2hex(random_bytes(32));

        return $token;
    }

    public function validateCSRFToken(string $token): bool
    {
        if (isset($_SESSION["csrf_token"]) && hash_equals($_SESSION["csrf_token"], $token)) {
            return true;
        }

        return false;
    }
}
