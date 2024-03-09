<?php

declare(strict_types=1);

namespace Framework;

use Framework\Exceptions\PageNotFoundException;
use UnexpectedValueException;
use ReflectionException;
use ReflectionMethod;

readonly class Dispatcher
{
    public function __construct(private Router $router, private Container $container)
    {
    }

    public function handle(Request $request): void
    {
        $path = $this->getPath($request->uri);

        $params = $this->router->match($path);

        if (!$params) {
            throw new PageNotFoundException("No route matched for the '$path' path");
        }

        /** Capitalize controller name (coming from route path) first letter using builtin @method ucwords(),
         * to match the controller file name
         */
        $controller = $this->getControllerName($params);
        $action = $this->getActionName($params);

        $controller_obj = $this->container->get($controller);

        $controller_obj->setRequest($request);
        $controller_obj->setViewer($this->container->get(TemplateViewerInterface::class));

        $args = $this->getActionArguments($controller_obj, $action, $params);

        $controller_obj->$action(...$args);
    }

    private function getPath(string $uri): string
    {
        /**
         * if the requested url is: http://phpmvc.localhost/home/index?page=1,
         * * $_SERVER['REQUEST_URI'] value ==> /home/index?page=1,
         * * parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ==> /home/index.
         * @var $path ==> /home/index
         */
        $path = parse_url($uri, PHP_URL_PATH);

        if (!$path) {
            throw new UnexpectedValueException("Malformed URL: '$uri'");
        }

        return $path;
    }

    private function getActionArguments($controller, $action, array $params): array
    {
        $args = [];

        try {
            /**
             * ReflectionMethod: returns the object (here $controller) Method (here $action), with
             * a lot of useful methods like: getName(), getParameters() etc...
             */
            $method = new ReflectionMethod($controller, $action);
            // loop through method parameters list
            foreach ($method->getParameters() as $parameter) {
                $param_name = $parameter->getName();
                // params coming from the handle() method
                // if there's parameter, it will be available in $params as a key
                $args[$param_name] = $params[$param_name];

            }
        } catch (ReflectionException $re) {
//            $re->getMessage();
        }

        return $args;

    }


    private function getControllerName(array $params): string
    {
        $controller = $params['controller'];

        $controller = str_replace('-', '', ucwords(strtolower($controller), '-'));

        $namespace = "App\Controllers";

        if (array_key_exists("namespace", $params)) {
            $namespace .= "\\" . $params['namespace'];
        }
        return $namespace . "\\" . $controller;
    }

    private function getActionName(array $params): string
    {
        $action = $params['action'];

        return lcfirst(str_replace('-', '', ucwords(strtolower($action), '-')));
    }
}