<?php

if(strpos($_SERVER['REQUEST_URI'], '/public') === 0) {
    return false;
}

$application = include 'application.php';
$application->getLocator()->getWeb()->run();

