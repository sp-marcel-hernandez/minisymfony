<?php

namespace SP\Infrastructure\Symfony\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

final class Psr7AdapterController implements RequestHandlerInterface
{
    /**
     * @var callable
     */
    private $sfController;
    private HttpFoundationFactory $sfFactory;
    private PsrHttpFactory $psrFactory;

    public function __construct(callable $sfController)
    {
        $psr17Factory = new Psr17Factory();
        $this->psrFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $this->sfFactory = new HttpFoundationFactory();
        $this->sfController = $sfController;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $sfRequest = $this->sfFactory->createRequest($request);
        $sfResponse = ($this->sfController)($sfRequest);

        return $this->psrFactory->createResponse($sfResponse);
    }
}
