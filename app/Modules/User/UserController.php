<?php

namespace App\Modules\User;

use App\Modules\User\UserRepository;
use App\Modules\User\Data\UserCreateData;
use Slim\Http\ServerRequest as Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class UserController {

    public function __construct($container) {
        $this->container = $container;
        $this->view = $container->get(Twig::class);
        $this->userRepository = $container->get(UserRepository::class);
    }

    public function index($req, $res) {
        return $this->view->render($res, "user/login.html", $user);
    }

    public function create($req, $res) {
        return $this->view->render($res, "user/register.html");
    }

    public function store(Request $req, $res) {
        $data = $req->getParams();

        $this->userRepository->insertUser($data);

        return $res->withHeader("Location", "/users/register"); 
    }
}