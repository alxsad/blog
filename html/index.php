<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../config.php');
$containerBuilder->useAnnotations(true);
$containerBuilder->useAutowiring(true);
$container = $containerBuilder->build();

$app = $container->get(\Alxsad\App\App::class);
$app->init();
$app->dispatch();
