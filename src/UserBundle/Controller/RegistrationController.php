<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 09:05
 */

namespace UserBundle\Controller;

use App\Controller\Controller;
use App\Request;
use UserBundle\FormType\RegisterType;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $registerType = new RegisterType();
        $form = $this->createForm(RegisterType::class, $registerType);

        var_dump($form->get('account'));

        $this->render('UserBundle/Registration/index.html.twig', array(
            'name' => 'Alexandre',
            'form' => $form
        ));
    }

    public function toto(Request $request)
    {
        $this->render('UserBundle/Registration/index.html.twig', array(
            'name' => 'Quentin'
        ));
    }
}