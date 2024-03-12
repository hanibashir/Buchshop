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
$router->add("/book/{slug:[\w-]+}", ["controller" => "books", "action" => "show"]);
$router->add("/books", ["controller" => "books", "action" => "index"]);

// Auth
$router->add("/register", ["controller" => "register", "action" => "index", "namespace" => "Auth"]);
$router->add("/login", ["controller" => "login", "action" => "index", "namespace" => "Auth"]);

// admin
$router->add("/admin/{controller}/{action}", ["namespace" => "Admin"]);
// users
$router->add("/users", ["controller" => "users", "action" => "index"]);
# generic route path
//$router->add("/{controller}/{id:\d+}/{action}");
//$router->add("/{controller}/{action}");

return $router;