<?php

namespace App\Services;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class AuthGuard {

    public function __invoke(Request $req, RequestHandler $handler) {
        $response = $handler->handle($req);
        $token = $req->getParam("token");

        if(!$token) {
            $response->getBody()->write(json_encode(["error" => "Usuário não autorizado."]));

            return $response->withHeader('Content-Type', 'application/json')->withStatus(401);
        }
        
        var_dump($response);
        die();
        return true;
    }
}