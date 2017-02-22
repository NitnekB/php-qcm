<?php

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 09:14
 */

namespace App;

class Kernel extends Component
{
    private static $bundles;

    public function __construct()
    {
        Kernel::$bundles = array();
        Kernel::$bundles = $this->registerBundles();
    }

    /**
     * Register all the bundles use by application
     *
     * @return array
     */
    public function registerBundles()
    {
        $this->addBundles(new \UserBundle\Controller\RegistrationController());

        return Kernel::$bundles;
    }

    /**
     * Add a bundle to associative bundles array
     *
     * @param string $bundle
     */
    public function addBundles($bundle)
    {
        Kernel::$bundles[str_replace('\\', ':', get_class($bundle))] = $bundle;
    }

    /**
     * Manage the user request
     *
     * @param HttpRequest $request
     */
    public function handle($server, $request)
    {
        $path = $server['REQUEST_URI'];

        $this->get('routing')->redirect($path);
    }

    public static function getBundles()
    {
        return Kernel::$bundles;
    }
}