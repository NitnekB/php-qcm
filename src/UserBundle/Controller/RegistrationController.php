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
use App\Service\RoutingService;
use UserBundle\Entity\User;
use UserBundle\FormType\RegisterType;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $registerType = new RegisterType();
        $form = $this->createForm(RegisterType::class, $registerType);

        $this->render('UserBundle/Registration/index.html.twig', array(
            'name' => 'Alexandre',
            'form' => $form
        ));
    }

    public function create(Request $request)
    {
        if ($request->post['password'] != $request->post['confirmation_password']) {
            /** @var RoutingService $routingService */
            $routingService = $this->get('routing');
            $request->setMethod('get');
            $routingService->redirect($routingService->path('register', 'get'), $request);
            return;
        }
    }

    public function toto(Request $request)
    {
        $this->render('UserBundle/Registration/index.html.twig', array(
            'name' => 'Quentin'
        ));
    }
}