<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 15:10
 */

namespace App\Component;

use App\Service\ServiceBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Yaml\Yaml;

abstract class Component
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Component constructor.
     */
    public function __construct()
    {
        $this->entityManager = $this->get('doctrine')->getEntityManager();
    }

    protected function get(string $serviceName)
    {
        $serviceBuilder = new ServiceBuilder();
        return $serviceBuilder->build($serviceName);
    }
}