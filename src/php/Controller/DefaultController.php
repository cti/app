<?php

namespace Controller;

use Cti\Core\Web;

class DefaultController
{
    function get()
    {
        echo 'Hello world!';
    }

    function getHello($name = 'World')
    {
        echo sprintf("Hello, %s!", $name);
    }

    function processChain(Web $web, $chain)
    {
        $string = 'Check you base location.<br/>No method found!<br/><br/>';
        $string .= 'Current base url: <b>%s</b><br/>Requested url: <b>%s</b>';
        echo sprintf($string, $web->getUrl(), $web->getUrl(implode('/', $chain)));
    }

}