<?php

include '../../vendor/autoload.php';

$locator = new Cti\Di\Locator;

$services = __DIR__ . '/services.php';
$locator->load($services);

$configuration = __DIR__ . '/config.php';
$locator->getManager()->getConfiguration()->load($configuration);

return $locator;