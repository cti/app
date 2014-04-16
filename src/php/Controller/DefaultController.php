<?php

namespace Controller;

use Cti\Core\Web;

/**
 * All your routings live in controllers
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
     * @param  Cti\Core\Web $web
     * @param  string $chain
     */
    function processChain(Web $web, $chain)
    {
        $string = 'Check you base location.<br/>No method found!<br/><br/>';
        $string .= 'Current base url: <b>%s</b><br/>Requested url: <b>%s</b>';
        echo sprintf($string, $web->getUrl(), $web->getUrl(implode('/', $chain)));
    }
}