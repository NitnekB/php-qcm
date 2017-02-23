<?php

namespace App\Service;

use App\Kernel;
use App\Request;
use Symfony\Component\Yaml\Yaml;

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 15:14
 */
class RoutingService
{
    /**
     * redirect to the specified url path
     * @param $path
     * @param Request $request
     */
    public function redirect($path, Request $request)
    {
        $routes = Yaml::parse(file_get_contents(__DIR__ . '/../../config/routes.yml'));
        $bundles = Kernel::getBundles();

        try {
            foreach ($routes as $route) {
                $routeUpper = strtolower($route['path']);
                $pathUpper = strtolower($path);

                $routeExploded = explode('/', $routeUpper);
                $pathExploded = explode('/', $pathUpper);

                if (count($routeExploded) != count($pathExploded)) {
                    continue;
                }

                $match = true;
                $params = [];
                for($i = 1; $i < count($routeExploded); $i++) {
                    if(strlen($routeExploded[$i]) > 0) {
                        if ($routeExploded[$i][0] == ':') {
                            $params[ltrim($routeExploded[$i], ':')] = $pathExploded[$i];
                        } else if($routeExploded[$i] != $pathExploded[$i]) {
                            $match = false;
                        }
                    }
                }

                if($match) {
                    $controller = explode(':', $route['controller']);
                    $class = $bundles[$controller[0] . ':Controller:' . $controller[1]];
                    $method = $controller[2];

                    $class->$method($request, $params);
                    return;
                }
            }
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }

        echo 'Controller not found (to update with 404)';
    }

    /**
     * Get the url for the specified path
     *
     * @param $path
     * @param null $method
     * @return string
     */
    public function path($path, $method = null, $options = null)
    {
        $routes = Yaml::parse(file_get_contents(__DIR__ . '/../../config/routes.yml'));

        try {
            $route = $routes[$path];

            if($route == null) {
                return '/';
            }

            if($method) {
                if(strtoupper($method) == strtoupper($route['method'])) {
                    return $route['path'];
                }
            } else {
                return $route['path'];
            }

            return '/';

        } catch(\Exception $exception) {
            die($exception->getMessage());
        }
    }
}