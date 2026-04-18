<?php

session_start();

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/config/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();
$router->handleRequest();
