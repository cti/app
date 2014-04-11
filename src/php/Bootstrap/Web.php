<?php

namespace Bootstrap;

use Cti\Di\Locator;
use Symfony\Component\Finder\Finder;

/**
 * For example we add all controllers to Web class.
 * It can be done via configuration, of course.
 * @package Boostrap
 */
class Web
{
    function init(Locator $locator)
    {
        $locator->register('web', function($locator) {

            // resource to get controllers folder
            $resource = $locator->getManager()->get('Cti\Core\ResourceLocator');
            
            // use finder for discover controller files
            $finder = new Finder();
            $finder->files()->name('*.php')->in($resource->path('src php Controller'));

            // collect them in array
            $controllers = array();
            foreach($finder as $file) {
                $controllers[] = 'Controller\\' . $file->getBasename('.php');
            }

            // set Web class controllers property.
            $locator->getManager()->getConfiguration()->set('Cti\Core\Web', 'controllers', $controllers);

            return $locator->getManager()->create('Cti\Core\Web');
        });
    }
}