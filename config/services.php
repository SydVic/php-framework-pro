<?php

$dotEnv = new \Symfony\Component\Dotenv\Dotenv();
$dotEnv->load(BASE_PATH . '/.env');

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));

# parameters for application config
$routes = include BASE_PATH . '/routes/web.php';
$appEnv = $_SERVER['APP_ENV'];
$templatesPath = BASE_PATH . '/templates';
#db connection
$dbConnection = $_SERVER['DB_CONNECTION'];
$dbUsername = $_SERVER['DB_USERNAME'];
$dbPassword = $_SERVER['DB_PASSWORD'];
$dbHost = $_SERVER['DB_HOST'];
$dbPort = $_SERVER['DB_PORT'];
$dbDatabase = $_SERVER['DB_DATABASE'];

$container->add('APP_ENV', new \League\Container\Argument\Literal\StringArgument($appEnv));

$databaseUrl = "$dbConnection://$dbUsername:$dbPassword@$dbHost:$dbPort/$dbDatabase";

$container->add(
    'base-commands-namespace',
    new \League\Container\Argument\Literal\StringArgument('SydVic\\Framework\\Console\\Command\\')
);

# services
$container->add(
    SydVic\Framework\Routing\RouterInterface::class,
    SydVic\Framework\Routing\Router::class
);

$container->extend(SydVic\Framework\Routing\RouterInterface::class)
    ->addMethodCall(
        'setRoutes',
        [new \League\Container\Argument\Literal\ArrayArgument($routes)]
    );

$container->add(
    \SydVic\Framework\Http\Middleware\RequestHandlerInterface::class,
    \SydVic\Framework\Http\Middleware\RequestHandler::class
)->addArgument($container);

$container->add(SydVic\Framework\Http\Kernel::class)
    ->addArguments([
        SydVic\Framework\Routing\RouterInterface::class,
        $container,
        \SydVic\Framework\Http\Middleware\RequestHandlerInterface::class
    ]);

$container->add(\SydVic\Framework\Console\Application::class)
    ->addArgument($container);

$container->add(\SydVic\Framework\Console\Kernel::class)
    ->addArguments([$container, \SydVic\Framework\Console\Application::class]);

$container->addShared(
    \SydVic\Framework\Session\SessionInterface::class,
    \SydVic\Framework\Session\Session::class
);

$container->add('template-renderer-factory', \SydVic\Framework\Template\TwigFactory::class)
    ->addArguments([
        \SydVic\Framework\Session\SessionInterface::class,
        new \League\Container\Argument\Literal\StringArgument($templatesPath)
    ]);

$container->addShared('twig', function () use ($container) {
    return $container->get('template-renderer-factory')->create();
});

$container->add(\SydVic\Framework\Controller\AbstractController::class);
$container->inflector(\SydVic\Framework\Controller\AbstractController::class)
    ->invokeMethod('setContainer', [$container]);

$container->add(\SydVic\Framework\Dbal\ConnectionFactory::class)
    ->addArguments([
        new \League\Container\Argument\Literal\StringArgument($databaseUrl)
    ]);

$container->addShared(\Doctrine\DBAL\Connection::class, function () use ($container): \Doctrine\DBAL\Connection {
    return $container->get(\SydVic\Framework\Dbal\ConnectionFactory::class)->create();
});

$container->add(
    'database:migrations:migrate',
    \SydVic\Framework\Console\Command\MigrateDatabase::class
)->addArguments([
    \Doctrine\DBAL\Connection::class,
    new \League\Container\Argument\Literal\StringArgument(BASE_PATH . '/migrations')
]);

$container->add(\SydVic\Framework\Http\Middleware\RouterDispatch::class)
    ->addArguments([
        \SydVic\Framework\Routing\RouterInterface::class,
        $container
    ]);

return $container;