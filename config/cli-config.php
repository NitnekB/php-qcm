<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Yaml\Yaml;

// replace with file to your own project bootstrap
require_once 'app/autoload.php';

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode, null, null, false);

$configPath = __DIR__ . '/app/config/database.yml';

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

$entityManager = EntityManager::create($conn, $config);

return ConsoleRunner::createHelperSet($entityManager);
