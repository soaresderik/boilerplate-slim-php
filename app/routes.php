<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Modules\User;
use App\Services\AuthGuard;
use Slim\Routing\RouteCollectorProxy ;

return function ($app) {
    // User Routes
    $app->group("/users", function (RouteCollectorProxy $group) {
        $group->post("/login", User\UserController::class . ":login");
        $group->get("/login", User\UserController::class . ":index");
        $group->post("/register", User\UserController::class . ":store")->add(AuthGuard::class);
    });
    
};

