<?php

if(strpos($_SERVER['REQUEST_URI'], '/public') === 0) {
    return false;
}

$application = include 'application.php';
$application
    ->inject('Cti\Core\Extension\WebExtension')
    ->inject('Cti\Direct\Extension')
    ->getLocator()->getWeb()->run();
