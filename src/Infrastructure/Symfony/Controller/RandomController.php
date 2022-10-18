<?php

namespace SP\Infrastructure\Symfony\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class RandomController
{
    public function __invoke(Request $request): Response
    {
        return new JsonResponse([
            'number' => random_int(0, $request->get('limit')),
        ]);
    }
}
