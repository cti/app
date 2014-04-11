<?php

chdir(__DIR__);

include '../../vendor/autoload.php';

$manager = new Cti\Di\Manager;

$configuration = __DIR__ . '/config.php';
$manager->getConfiguration()->load($configuration);

return $manager;