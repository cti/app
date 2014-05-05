<?php

namespace Controller;

use Cti\Core\Module\Web;

/**
 * All your routes live in controllers
 * Default controller mounts to /
 * Request consist of url and method (get, post). 
 * When add route to controller you must join this string
 * @package Boostrap
 */
class DefaultController
{
    /**
     * this method will be called when you request / with GET method
     */
    function get()
    {
        echo 'This is index page!';
    }

    /**
     * if no method was found you can process request by yourseld
     * chain is url pieces delimited by /
     * you can inject any parameter (thanks to di)
     * @param Web $web
     * @param array $chain
     */
    function processChain(Web $web, $chain)
    {
        $output = <<<VIEW
    Check you base location.<br/>
    No method found!<br/>
    <br/>
    Current base url: <b>%s</b><br/>
    Requested url: <b>%s</b>
VIEW;
        echo sprintf($output, $web->getUrl(), $web->getUrl(implode('/', $chain)));
    }
}