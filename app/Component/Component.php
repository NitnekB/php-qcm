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
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../src"), $isDevMode);

        $configPath = __DIR__ . '/../../config/database.yml';

        if(!file_exists($configPath)) {
            $configPath = $configPath . '.dist';
        }

        $configDB = Yaml::parse(file_get_contents($configPath));

        $conn = array(
            'dbname' => $configDB['dbname'],
            'user' => $configDB['user'],
            'password' => $configDB['password'],
            'host' => $configDB['host'],
            'driver' => $configDB['driver'],
        );

        $this->entityManager = EntityManager::create($conn, $config);
    }

    protected function get(string $serviceName)
    {
        $serviceBuilder = new ServiceBuilder();
        return $serviceBuilder->build($serviceName);
    }
}