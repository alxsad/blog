<?php

use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use Relay\RelayBuilder;
use Alxsad\App\Middleware;
use Alxsad\App\Controller\PostController;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../config.php');
$containerBuilder->useAnnotations(true);
$containerBuilder->useAutowiring(true);
$container = $containerBuilder->build();

$request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
$response = new Response();

$relayBuilder = new RelayBuilder();
$relay = $relayBuilder->newInstance([
    new Middleware\FastRouteMiddleware(
        $container,
        FastRoute\simpleDispatcher(function (RouteCollector $r) {
            $r->addRoute('GET', '/posts', [PostController::class, 'list']);
        })
    )
]);
$response = $relay($request, $response);

$emitter = new SapiEmitter();
$emitter->emit($response);
