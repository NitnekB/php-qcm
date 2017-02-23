<?php

namespace App\Controller;
use App\Component\Component;
use App\Component\Form\AbstractType;
use App\Component\Form\FormBuilderInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 11:21
 *
 */
class Controller extends Component
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

        // todo : prod
        /*$twig = new Twig_Environment($loader, array(
            'cache' => './Form/cache',
        ))*/;

        // todo : dev
        $twig = new Twig_Environment($loader, array('auto_reload' => true));
        $pathFunc = new \Twig_Function('path', array($this->get('routing'), 'path'));
        $twig->addFunction($pathFunc);

        $template = $twig->load($path);
        echo $template->render($vars);
    }

    /**
     * Create a form for the specified class and instance
     *
     * @param $class
     * @param $instance
     */
    protected function createForm($class, AbstractType $instance)
    {
        $formBuilderInterface = new FormBuilderInterface($instance);

        return $instance->buildForm($formBuilderInterface);
    }
}