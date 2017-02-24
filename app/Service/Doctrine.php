<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 22:19
 */

namespace App\Service;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Yaml\Yaml;

class Doctrine
{
    /**
     * @var Doctrine
     */
    private static $instance;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct()
    {
        if(Doctrine::$instance == null) {
            Doctrine::$instance = $this;
            $this->buildDoctrine();
        }
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if(Doctrine::$instance == null) {
            Doctrine::$instance = new Doctrine();
        }

        return Doctrine::$instance->entityManager;
    }

    /**
     * Build doctrine and entity manager
     */
    private function buildDoctrine()
    {
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../../src"), $isDevMode, null, null, false);

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

        Doctrine::$instance = $this;
    }
}