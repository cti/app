<?php

// all properties can be overriden in local.config.php
// it is ignored by git, so this is your local configuration override
return array(

    // set locator root project path
    'Cti\Core\ResourceLocator' => array(
        dirname(dirname(__DIR__)),
    ),    

    // set default base path
    'Cti\Core\Web' => array(
        'base' => '/',
    ),

);