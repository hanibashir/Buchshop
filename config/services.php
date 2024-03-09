<?php

use App\Database;
use Framework\Container;
use Framework\TemplateViewer;
use Framework\TemplateViewerInterface;

/**
 * Because the container @method get() will throw exception if the object constructor contains arguments of primitives
 * types (e.g. string, int etc...) and not of type ReflectionNamedType, we need to tell the container how to create an
 * Object such as this.
 * We do this by maintaining a registry of these classes
 */

$container = new Container;
// binding a value for the database class to the service container
$container->set(Database::class, function () {
    return new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
});
//$database = new \App\Database("localhost", "product_db", "product_db_user", "secret");
//$container->set(\App\Database::class, $database);

$container->set(TemplateViewerInterface::class, function () {
    return new TemplateViewer;
});

// binding a value for the request class to the service container
//$container->set(Request::class, function () {
//    return Request::createFromGlobals();
//});


return $container;