<?php

include '../../vendor/autoload.php';

$locator = new Cti\Di\Locator;

$locator->load(__DIR__ . '/services.php');
$locator->getManager()->getConfiguration()->load(__DIR__ . '/config.php');

return $locator;