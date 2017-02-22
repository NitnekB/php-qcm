<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 09:05
 */

namespace UserBundle\Controller;

use App\Controller\Controller;

class RegistrationController extends Controller
{
    public function index()
    {
        $this->render('UserBundle/Registration/index.html.twig', array(
            'name' => 'Alexandre'
        ));
    }

    public function toto()
    {
        $this->render('UserBundle/Registration/index.html.twig', array(
            'name' => 'Quentin'
        ));
    }
}