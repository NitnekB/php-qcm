<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 15:10
 */

namespace App;

use App\Service\ServiceBuilder;

class Component
{
    protected function get(string $serviceName)
    {
        $serviceBuilder = new ServiceBuilder();
        return $serviceBuilder->build($serviceName);
    }
}