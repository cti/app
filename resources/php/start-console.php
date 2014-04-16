<?php

$application = include 'application.php';
$application
    ->inject('Cti\Core\Extension\ConsoleExtension')
    ->getLocator()->getConsole()->run();