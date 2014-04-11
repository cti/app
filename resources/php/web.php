<?php

$locator = include 'locator.php';

if(strpos($_SERVER['REQUEST_URI'], '/public')===0) {
    return false;
}

$locator->getWeb()->process();

