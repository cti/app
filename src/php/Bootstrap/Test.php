<?php

namespace Bootstrap;

use Cti\Di\Locator;

/**
 * This class would be instantiate on application start
 */
class Test
{
    function init(Locator $locator)
    {
        // if you to register in locator
        $locator->register('test', $this);
    }
}