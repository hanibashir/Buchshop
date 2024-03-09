<?php
$router = new Framework\Router;
/**
 * Adds routes to the Routing Table
 * If the user enters a path other than the specified ones, the match function will return false.
 * otherwise, the match function will return array contains Controller name and action, e.g.:
 * ["controller" => "home", "action" => "index"]
 */

// home
$router->add("/", ["controller" => "home", "action" => "index"]);
$router->add("/home/index", ["controller" => "home", "action" => "index"]);
// books
$router->add("/product/{slug:[\w-]+}", ["controller" => "books", "action" => "show"]);
$router->add("/products", ["controller" => "books", "action" => "index"]);
// Auth
// admin
$router->add("/admin/{controller}/{action}", ["namespace" => "Admin"]);
// user

# generic route path
$router->add("/{controller}/{id:\d+}/{action}");
$router->add("/{controller}/{action}");

return $router;