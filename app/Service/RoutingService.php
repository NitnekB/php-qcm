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
    public function redirect($path)
    {
        $routes = Yaml::parse(file_get_contents(__DIR__ . '/../config/routes.yml'));
        $bundles = Kernel::getBundles();

        try {
            foreach ($routes as $route) {
                if ($route['path'] === $path) {
                    $controller = explode(':', $route['controller']);
                    $class = $bundles[$controller[0] . ':Controller:' . $controller[1]];
                    $method = $controller[2];

                    $class->$method();

                    return;
                }
            }
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }
}