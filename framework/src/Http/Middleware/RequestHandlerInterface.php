<?php

namespace SydVic\Framework\Http\Middleware;

use SydVic\Framework\Http\Request;
use SydVic\Framework\Http\Response;

interface RequestHandlerInterface
{
    public function handle(Request $request): Response;
}