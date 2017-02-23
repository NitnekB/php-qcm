<?php

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 09:14
 */

namespace App;

use App\Component\Component;

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
        $this->addBundles(new \UserBundle\Controller\LoginController());
        $this->addBundles(new \QcmBundle\Controller\DefaultController());
        $this->addBundles(new \QcmBundle\Controller\TopicController());

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

        $appRequest = new Request($server);

        $this->get('routing')->redirect($path, $appRequest);
    }

    public static function getBundles()
    {
        return Kernel::$bundles;
    }
}