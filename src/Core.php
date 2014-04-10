<?php

namespace Application;

class Core 
{
    /**
     * @inject
     * @var Cti\Core\Web
     */
    protected $web;

    function processWeb()
    {
        $this->web->add('/', 'Application\Controller\DefaultController');
        $this->web->process();
    }
}