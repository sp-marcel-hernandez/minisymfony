<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use SP\Infrastructure\Symfony\Controller\RandomController;
use SP\Infrastructure\Symfony\Controller\Psr7AdapterController;
use UMA\DIC\Container;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$container->set(RandomController::class, new Psr7AdapterController(new RandomController()));
$app = AppFactory::create(container: $container);
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
$app->get('/random/{limit}', RandomController::class);

$app->run();
