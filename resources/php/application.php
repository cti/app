<?php

// when calling script from root location can be different
chdir(__DIR__);

include '../../vendor/autoload.php';

$application = Cti\Core\Application::create(__DIR__ . '/config.php');

return $application;
