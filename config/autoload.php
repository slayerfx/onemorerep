<?php

// models
require_once __DIR__ . "/../models/MuscleGroup.php";
require_once __DIR__ . "/../models/Exercise.php";
require_once __DIR__ . "/../models/User.php";

// services
require_once __DIR__ . "/../services/Router.php";
require_once __DIR__ . "/../services/CSRFTokenManager.php";

// controllers
require_once __DIR__ . "/../controllers/AbstractController.php";
require_once __DIR__ . "/../controllers/HomeController.php";
require_once __DIR__ . "/../controllers/ExerciseController.php";
require_once __DIR__ . "/../controllers/AuthController.php";
require_once __DIR__ . "/../controllers/AdminController.php";

// managers
require_once __DIR__ . "/../managers/AbstractManager.php";
require_once __DIR__ . "/../managers/ExerciseManager.php";
require_once __DIR__ . "/../managers/UserManager.php";
require_once __DIR__ . "/../managers/MuscleGroupManager.php";
