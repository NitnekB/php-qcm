<?php

namespace App\Service;

use App\Kernel;
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
     * @param null $params
     */
    public function redirect($path, $params = null)
    {
        $routes = Yaml::parse(file_get_contents(__DIR__ . '/../config/routes.yml'));
        $bundles = Kernel::getBundles();

        try {
            foreach ($routes as $route) {
                if ($route['path'] === $path) {
                    $controller = explode(':', $route['controller']);
                    $class = $bundles[$controller[0] . ':Controller:' . $controller[1]];
                    $method = $controller[2];

                    $class->$method($params);

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
    public function path($path, $method = null)
    {
        $routes = Yaml::parse(file_get_contents(__DIR__ . '/../config/routes.yml'));

        try {
            $route = $routes[$path];

            if($route == null) {
                return '/';
            }

            if($method) {
                if($method == $route['method']) {
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