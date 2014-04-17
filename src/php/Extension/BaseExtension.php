<?php

namespace Extension;

use Cti\Core\Application;

class BaseExtension
{
    function init(Application $application)
    {
        $application
            ->extend('Cti\Core\Extension\ConsoleExtension')
            ->extend('Cti\Core\Extension\WebExtension')
            ->extend('Cti\Direct\Extension')
        ;
    }
    
}