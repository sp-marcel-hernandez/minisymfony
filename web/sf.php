<?php

declare(strict_types=1);

use SP\Infrastructure\Symfony\Kernel;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../vendor/autoload.php';


$kernel = new Kernel('dev', true);

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
