<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/config/autoload.php";

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();
$router->handleRequest();
