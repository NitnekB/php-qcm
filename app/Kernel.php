<?php

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 09:14
 */

namespace App;

use ReflectionMethod;
use Symfony\Component\Yaml\Yaml;

class Kernel
{
    private $bundles;

    public function __construct()
    {
        $this->bundles = $this->registerBundles();
    }

    /**
     * Register all the bundles use by application
     *
     * @return array
     */
    public function registerBundles()
    {
        $this->bundles = array();

        $this->addBundles(new \UserBundle\Controller\RegistrationController());

        return $this->bundles;
    }

    /**
     * Add a bundle to associative bundles array
     *
     * @param string $bundle
     */
    public function addBundles($bundle)
    {
        $this->bundles[str_replace('\\', ':', get_class($bundle))] = $bundle;
    }

    /**
     * Manage the user request
     *
     * @param HttpRequest $request
     */
    public function handle($server, $request)
    {
        $path = $server['REQUEST_URI'];

        $routes = Yaml::parse(file_get_contents(__DIR__ . '/../config/routes.yml'));

        try {
            foreach ($routes as $route) {
                if ($route['path'] === $path) {
                    $controller = explode(':', $route['controller']);
                    $class = $this->bundles[$controller[0] . ':Controller:' . $controller[1]];
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