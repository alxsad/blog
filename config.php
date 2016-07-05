<?php

use function DI\object;
use function DI\factory;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Alxsad\Domain\Repository\PostRepository;
use Alxsad\Infrastructure\Repository\InMemoryPostRepository;
use Alxsad\App\Controller\PostController;

return [
    PostController::class => object(PostController::class),

    PostRepository::class => object(InMemoryPostRepository::class),

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
