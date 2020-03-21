<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Modules\User;

return function ($app) {
    $app->get("/users/login", User\UserController::class . ":index");
    $app->get("/users/register", User\UserController::class . ":create");
    $app->post("/users/register", User\UserController::class . ":store");
};

