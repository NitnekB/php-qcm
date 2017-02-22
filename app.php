<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 08:50
 */

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__ . '/app/autoload.php';

$kernel = new App\Kernel();

$kernel->handle($_SERVER, $_REQUEST);

