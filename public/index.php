<?php
/**
 * Front Controller
 */
declare(strict_types=1);

use Framework\Dispatcher;
use Framework\DotEnv;
use Framework\Request;

define("ROOT_PATH", dirname(__DIR__)); // e.g. C:\xampp\htdocs\Buchshop


/**
 * Autoload classes
 * using @method str_replace() to replace '\' with '/', because backslashes work only in windows,
 * and forward slashes work in all operating systems.
 */
spl_autoload_register(function (string $class_name) {
    require ROOT_PATH . "/src/" . str_replace('\\', '/', $class_name) . ".php";
});

$dot_env = new DotEnv;

$dot_env->load(ROOT_PATH . "/.env");

set_error_handler("Framework\ErrorHandler::handleError");

set_exception_handler("Framework\ErrorHandler::exceptionHandler");


$router = require ROOT_PATH . "/config/routes.php";

$container = require ROOT_PATH . "/config/services.php";

$dispatcher = new Dispatcher($router, $container);
$request = Request::createFromGlobals();
$dispatcher->handle($request);


