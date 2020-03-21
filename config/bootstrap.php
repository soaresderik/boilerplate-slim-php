<?php

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(__DIR__ . '/container.php');

$container = $containerBuilder->build();

$app = $container->get(App::class);

(require __DIR__ . '/../app/routes.php')($app);

(require __DIR__ . '/../app/middleware.php')($app);

return [$app, $container];