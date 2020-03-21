<?php

use Psr\Container\ContainerInterface;

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Selective\Config\Configuration;
use App\Modules\User\UserController;
use App\Modules\User\UserRepository;
use Doctrine\ORM\EntityManager;
use Slim\Factory\AppFactory;
use Doctrine\ORM\Tools\Setup;
use Slim\Views\Twig;
use Slim\App;
use PDO;

return [
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        
        return $app;
    },

    // User
    UserController::class => function (ContainerInterface $container) {
        return new UserController($container);
    },

    UserRepository::class => function (ContainerInterface $container) {
        return new UserRepository($container->get(PDO::class));
    },

    // View
    Twig::class => function ($container) {
        $c = $container->get(Configuration::class);
        return Twig::create($c->getString("root") . "/templates");
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