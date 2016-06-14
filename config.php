<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Alxsad\Domain\PostRepository;
use Alxsad\Infrastructure\InMemoryPostRepository;
use function DI\object;
use function DI\factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\Response\EmitterInterface;
use Zend\Diactoros\ServerRequestFactory;
use Alxsad\App\Controller\PostController;

return [

    // http psr-7

    ResponseInterface::class => object(Response::class),

    EmitterInterface::class => object(SapiEmitter::class),

    ServerRequestInterface::class => function () {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );
    },

    // application

    PostController::class => object(PostController::class),

    // domain

    PostRepository::class => object(InMemoryPostRepository::class),

    // infrastructure

    Twig_Environment::class => function () {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
        return new Twig_Environment($loader);
    },

    LoggerInterface::class => factory(function () {
        $logger = new Logger('mylog');
        $handler = new StreamHandler('app.log', Logger::DEBUG);
        $handler->setFormatter(new LineFormatter());
        $logger->pushHandler($handler);
        return $logger;
    }),
];
