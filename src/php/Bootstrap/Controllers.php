<?php

namespace Bootstrap;

use Cti\Core\ResourceLocator;
use Cti\Di\Configuration;
use Symfony\Component\Finder\Finder;

/**
 * Boostrap class executes on application start
 * For example we add all controllers to Web class.
 * It can be set via configuration, of course.
 * @package Boostrap
 */
class Controllers
{
    function init(Configuration $configuration, ResourceLocator $locator)
    {
        $finder = new Finder();
        $finder->files()->name('*.php')->in($locator->path('src php Controller'));
        
        $controllers = array();
        foreach($finder as $file) {
            $controllers[] = 'Controller\\' . $file->getBasename('.php');
        }

        $configuration->set('Cti\Core\Web', 'controllers', $controllers);
    }
}