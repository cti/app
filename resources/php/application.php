<?php

use Cti\Core\Application\Factory;

// when calling script from root location can be different
chdir(__DIR__);

include '../../vendor/autoload.php';

$factory = Factory::create(__DIR__ . '/config.php');

return $factory->getApplication();