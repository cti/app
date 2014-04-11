<?php

// when calling script from root location can be different
chdir(__DIR__);

include '../../vendor/autoload.php';

// create manager
$locator = new Cti\Di\Locator;

// load configuration
$configuration = __DIR__ . '/config.php';
$locator->getManager()->getConfiguration()->load($configuration);

// process application bootstrap files
$locator->getManager()->get('Cti\Core\Bootstrap');

// return service locator
return $locator;