<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entityManager = (require_once __DIR__ . "/config/bootstrap.php")[1]->get(EntityManager::class);

return ConsoleRunner::createHelperSet($entityManager);
