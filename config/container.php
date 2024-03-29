<?php

use Psr\Container\ContainerInterface;

use Selective\Config\Configuration;
use App\Modules\User\UserController;
use App\Modules\User\UserRepository;
use Rakit\Validation\Validator;
use Slim\Flash\Messages;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\App;
use PDO;

return [
    // App
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        
        return $app;
    },

    Validator::class => function () {
        return new Validator();
    },

    Messages::class => function () {
        return new Messages();
    },

    Twig::class => function ($container) {
        $c = $container->get(Configuration::class);

        $view = Twig::create($c->getString("root") . "/templates", 
            ["cache" => $c->getString("cache_path")]
        );

        $env = $view->getEnvironment();
        $env->addGlobal('messages', $container->get(Messages::class)->getMessages());
        $env->addGlobal('session', $_SESSION);

        return $view;
    },

    // User
    UserController::class => function (ContainerInterface $container) {
        return new UserController($container);
    },

    UserRepository::class => function (ContainerInterface $container) {
        return new UserRepository($container->get(PDO::class));
    },

    // Database
    PDO::class => function (ContainerInterface $container) {
        $c = $container->get(Configuration::class);
    
        $host = $c->getString('db.host');
        $dbname =  $c->getString('db.database');
        $username = $c->getString('db.username');
        $password = $c->getString('db.password');
        $charset = $c->getString('db.charset');
        $flags = $c->getArray('db.flags');
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    
        return new PDO($dsn, $username, $password, $flags);
    },
];