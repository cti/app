<?php

namespace Bootstrap;

use Cti\Di\Locator;
use Symfony\Component\Finder\Finder;

/**
 * Boostrap class executes on application start
 * Console service registration
 * @package Boostrap
 */
class Console
{
    function init(Locator $locator)
    {
        $locator->register('console', function($locator) {

            // resource to get controllers folder
            $resource = $locator->getManager()->get('Cti\Core\ResourceLocator');
            
            // use finder for discover command files
            $finder = new Finder();
            $finder->files()->name('*.php')->in($resource->path('src php Command'));

            // create application 
            $console = $locator->getManager()->get('Symfony\Component\Console\Application');            

            // collect them in array
            $controllers = array();
            foreach($finder as $file) {
                $console->add($locator->getManager()->get('Command\\' . $file->getBasename('.php')));
            }

            return $console;
        });
    }
}