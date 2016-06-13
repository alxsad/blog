<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class IndexController
{
    public function someMethod(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response;
    }
}
