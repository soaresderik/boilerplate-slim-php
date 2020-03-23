<?php

namespace App\Modules\User;

use App\Modules\User\Data\UserCreateData;
use App\Modules\User\UserRepository;
use Selective\Config\Configuration;
use Rakit\Validation\Validator;
use Slim\Http\ServerRequest as Request;
use ReallySimpleJWT\Token;
use Slim\Flash\Messages;
use Slim\Http\Response;
use Slim\Views\Twig;

class UserController {

    public function __construct($c) {
        $this->view = $c->get(Twig::class);
        $this->userRepository = $c->get(UserRepository::class);
        $this->validator = $c->get(Validator::class);
        $this->messages = $c->get(Messages::class);
        $this->JWTSecret = $c->get(Configuration::class)->getString("jwt.secret");
        // $this->
    }

    public function index($req, $res) {
        return $this->view->render($res, "user/login.html");
    }

    public function login($req, $res) {
        try {
            $body = $req->getParams();

            $user = $this->userRepository->getUserByEmail($body["email"]);

            $message = "Usuário ou senha incorreto.";
            if(!$user) return $res->withJson(["error" => $message], 401);

            if(!password_verify($body["password"], $user["password"]))
                return $res->withJson(["error" => $message], 401);

            $token = Token::create($user["id"], $this->JWTSecret, time() + 3600, "authenticated");

            return $res->withJson(["token" => $token]); 
        } catch (\Exception $err){
            return $res->withJson(["error" => "Ocorreu um erro no sistema!"], 500);
        }
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
            return $res->withJson(["errors" => $validation->errors()->all()], 400);
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