<?php

namespace SydVic\Framework\Http\Middleware;

use SydVic\Framework\Http\Request;
use SydVic\Framework\Http\Response;
use SydVic\Framework\Session\SessionInterface;

class StartSession implements MiddlewareInterface
{
    public function __construct(
        private SessionInterface $session
    )
    {
    }

    public function process(Request $request, RequestHandlerInterface $requestHandler): Response
    {
        $this->session->start();

        $request->setSession($this->session);

        return $requestHandler->handle($request);
    }
}