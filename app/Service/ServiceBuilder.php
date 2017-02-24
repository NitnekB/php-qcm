<?php

namespace App\Service;

use ReflectionClass;
use Symfony\Component\Yaml\Yaml;

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 15:17
 */
class ServiceBuilder
{
    private $services;

    /**
     * ServiceBuilder constructor.
     */
    public function __construct()
    {
        $this->services = Yaml::parse(file_get_contents(__DIR__ . '/../../config/services.yml'));
    }

    /**
     * @param string $serviceName
     * @return null|object
     */
    public function build(string $serviceName)
    {
        $service = $this->services[$serviceName];

        if($service == null) {
            return null;
        }

        $serviceObj = new ReflectionClass($service['class']);

        return $serviceObj->newInstance();
    }
}