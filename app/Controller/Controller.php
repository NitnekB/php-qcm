<?php

namespace App\Controller;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 11:21
 *
 */
class Controller
{
    /**
     * Render the view for the controller
     *
     * @param string $path
     * @param array $vars
     */
    protected function render(string $path, array $vars)
    {
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../../resources/Views/');

        // todo : dev & prod
        /*$twig = new Twig_Environment($loader, array(
            'cache' => './app/cache',
        ))*/;

        // todo : dev & prod
        $twig = new Twig_Environment($loader, array('auto_reload' => true));

        $template = $twig->load($path);
        echo $template->render($vars);
    }
}