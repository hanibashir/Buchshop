<?php

declare(strict_types=1);

namespace Framework;

use Closure;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;

class Container
{
    private array $registry = [];

    public function set(string $name, Closure $value): void
    {
        $this->registry[$name] = $value;
    }

    //Recursive function
    public function get(string $class_name): object
    {
        $dependencies = [];

        /**
         * if the $class_name has a constructor with primitive types,
         * then it will be added to the registry array by set()
         */
        if (array_key_exists($class_name, $this->registry)) {
            return $this->registry[$class_name]();
        }

        try {
            $reflector = new ReflectionClass($class_name);
            $constructor = $reflector->getConstructor();

            // Recursive call base case
            if ($constructor === null) {
                return new $class_name;
            }

            foreach ($constructor->getParameters() as $parameter) {
                $type = $parameter->getType();

                if ($type === null) {
                    throw new \InvalidArgumentException(
                        "Constructor parameter '{$parameter->getName()}'
                        in the {$class_name} class has no type declaration"
                    );
                }

                if (!($type instanceof ReflectionNamedType)) {
                    throw new \InvalidArgumentException(
                        "Constructor parameter '{$parameter->getName()}'
                        in the {$class_name} class is an invalid type: {$type}
                    - only single named type supported"
                    );
                }

                if ($type->isBuiltIn()) {
                    throw new \InvalidArgumentException("Unable to resolve constructor
                    parameter '{$parameter->getName()}' of type '{$type}' in the '{$class_name}' class");
                }

                // call dependency recursively
                $dependencies[] = $this->get((string)$type);
            }

        } catch (ReflectionException $re) {
            // $re.getMessage();
        }

        return new $class_name(...$dependencies);
    }
}