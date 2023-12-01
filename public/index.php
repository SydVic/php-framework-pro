<?php declare(strict_types=1);
# error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use SydVic\Framework\Http\Kernel;
use SydVic\Framework\Http\Request;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

$container = require BASE_PATH . '/config/services.php';

//request received
$request = Request::createFromGlobals();

// perform some logic
$kernel = $container->get(Kernel::class);

// send response
$response = $kernel->handle($request);

$response->send();