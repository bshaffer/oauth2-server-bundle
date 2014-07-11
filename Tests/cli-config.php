<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use OAuth2\ServerBundle\Tests\ContainerLoader;

// autoloading, etc
require_once __DIR__.'/bootstrap.php';

// create "test" service container
$container = ContainerLoader::buildTestContainer();
$entityManager = $container->get('doctrine.orm.entity_manager');

return ConsoleRunner::createHelperSet($entityManager);