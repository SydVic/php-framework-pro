<?php

use SydVic\Framework\Http\Response;

return [
    // PHPINFO
    ['GET', '/phpinfo', [\App\Controller\HomeController::class, 'phpinfo']],

    // HOME
    ['GET', '/', [\App\Controller\HomeController::class, 'index']],

    // AUTH
    ['GET', '/register', [\App\Controller\Auth\RegistrationController::class, 'create']],
    ['POST', '/register', [\App\Controller\Auth\RegistrationController::class, 'store']],
    ['GET', '/login', [\App\Controller\Auth\LoginController::class, 'index']],
    ['POST', '/login', [\App\Controller\Auth\LoginController::class, 'login']],

    // POSTS
    ['GET', '/posts/{id:\d+}', [\App\Controller\PostsController::class, 'show']],
    ['GET', '/posts/create', [\App\Controller\PostsController::class, 'create']],
    ['POST', '/posts/store', [\App\Controller\PostsController::class, 'store']],
    ['GET', '/hello/{name:.+}', function(string $name) {
        return new Response("Hello $name");
    }],
];