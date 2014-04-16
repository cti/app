<?php

$application = include 'application.php';

$application
    ->extend('Cti\Core\Extension\ConsoleExtension')
    ->getConsole()
    ->run();