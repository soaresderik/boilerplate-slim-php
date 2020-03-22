<?php

namespace App\Modules\User;

use App\Modules\User\UserRepository;
use App\Modules\User\Data\UserCreateData;
use Rakit\Validation\Validator;
use Slim\Http\ServerRequest as Request;
use Slim\Flash\Messages;
use Slim\Http\Response;
use Slim\Views\Twig;

class UserController {

    public function __construct($c) {
        $this->view = $c->get(Twig::class);
        $this->userRepository = $c->get(UserRepository::class);
        $this->validator = $c->get(Validator::class);
        $this->messages = $c->get(Messages::class);
    }

    public function index($req, $res) {
        return $this->view->render($res, "user/login.html");
    }

    public function create($req, $res) {
        return $this->view->render($res, "user/register.html");
    }

    public function store(Request $req, Response $res) {
        $data = $req->getParams();

        $validation = ($this->validator->make($data, [
            "name" => "required",
            "email" => "required",
            "password" => "required|min:6"
        ]));

        $validation->validate();

        if($validation->fails()) {
            $this->messages->addMessage('messages', $validation->errors()->all());

            return $res->withHeader("Location", "/users/register");
        }

        $user = [
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => password_hash($data["password"], PASSWORD_DEFAULT) 
        ];

        $this->userRepository->insertUser($user);

        return $res->withHeader("Location", "/users/login"); 
    }
}