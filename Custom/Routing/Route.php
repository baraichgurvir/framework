<?php

namespace Framework\Routing;

use Framework\Helpers\Libraries\Command;
use ReflectionMethod;

class Route {
    private static array $routes = [];

    /**
     * get: Responsible for setting all the get routes
     *
     * @param string $path
     * @param string|array $methods
     * @return void
     */
    public static function get(string $path, string|array $methods) {
        self::$routes[] = arrayToObject(["method" => "GET", "path" => $path, "onExecute" => $methods]);
    }

    /**
     * post: Responsible for setting all the post routes
     *
     * @param string $path
     * @param string|array $methods
     * @return void
     */
    public static function post(string $path, string|array $methods) {
        self::$routes[] = arrayToObject(["method" => "POST", "path" => $path, "onExecute" => $methods]);
    }

    private static function getFunctionParametersTypes(string $method) {
        $types = [];
        
        $function = new ReflectionMethod($method);
        foreach ($function->getParameters() as $param) {
            $types[] = $param->getType()->getName();
        }

        return $types;
    }

    /**
     * liveChecks: Responsible for displaying all the content on the webpage.
     *
     * @return void
     */
    public static function liveChecks() {
        $request = arrayToObject(["method" => $_SERVER['REQUEST_METHOD'], "path" => preg_replace('/(\?.*)/m', '' ,$_SERVER['REQUEST_URI'])]);
        
        /** Mapping through all the routes */
        foreach (self::$routes as $route) {
            /** Checking Method ex: GET, POST */
            if ($request->method == $route->method) {
                /** Checking Path that exact matches to user defined path */
                if ($request->path == $route->path) {
                    /** Call user set function on the route */
                    if (isArray($route->onExecute)) {
                        $class = new $route->onExecute[0];
                        $method = $route->onExecute[1];

                        $types = self::getFunctionParametersTypes(get_class($class) . "::" . $method);
                        
                        foreach ($types as $key => $type) {
                            if (class_exists($type)) {
                                $types[$key] = new $type();
                            }
                        }

                        $command = $class->$method(...$types);

                        if ($command != null)
                            Command::execute($command);
                    } else {
                        $function = $route->onExecute;

                        $types = self::getFunctionParametersTypes($function);
                        
                        foreach ($types as $key => $type) {
                            if (class_exists($type)) {
                                $types[$key] = new $type();
                            }
                        }

                        $function(...$types);
                    }
                }
            }
        }
    }
}