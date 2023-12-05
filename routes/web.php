<?php

use SydVic\Framework\Http\Response;

return [
    ['GET', '/phpinfo', [\App\Controller\HomeController::class, 'phpinfo']],
    ['GET', '/', [\App\Controller\HomeController::class, 'index']],
    ['GET', '/posts/{id:\d+}', [\App\Controller\PostsController::class, 'show']],
    ['GET', '/posts/create', [\App\Controller\PostsController::class, 'create']],
    ['POST', '/posts/store', [\App\Controller\PostsController::class, 'store']],
    ['GET', '/hello/{name:.+}', function(string $name) {
        return new Response("Hello $name");
    }],
];