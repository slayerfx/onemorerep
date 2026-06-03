<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/config/autoload.php";

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (empty($_SESSION["csrf_token"])) {
    $tokenManager = new CSRFTokenManager();
    $_SESSION["csrf_token"] = $tokenManager->generateCSRFToken();
}

$router = new Router();
$router->handleRequest();
