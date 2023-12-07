<?php

namespace SydVic\Framework\Http\Middleware;

use SydVic\Framework\Http\Request;
use SydVic\Framework\Http\Response;

interface MiddlewareInterface
{
    public function process(Request $request, RequestHandlerInterface $requestHandler): Response;
}