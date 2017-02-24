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
use UserBundle\Entity\UserRepository;
use UserBundle\FormType\RegisterType;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        if($this->get('session-manager')->getCurrentUser()) {
            header('Location: /');
            return;
        }

        $registerType = new RegisterType();
        $form = $this->createForm(RegisterType::class, $registerType);

        $this->render('UserBundle/Registration/index.html.twig', array(
            'name' => 'Alexandre',
            'form' => $form
        ));
    }

    public function create(Request $request)
    {
        /** @var RoutingService $routingService */
        $routingService = $this->get('routing');
        $request->setMethod('get');

        if($this->get('session-manager')->getCurrentUser()) {
            header('Location: /');
            return;
        }

        if(
            !isset($request->post['password'])
            || !isset($request->post['email'])
            || !isset($request->post['account'])
        ) {
            $routingService->redirect($routingService->path('register', 'get'), $request);
            return;
        }

        if ($request->post['password'] != $request->post['confirmation_password']) {
            unset($request->post['password']);
            unset($request->post['confirmation_password']);
            $routingService->redirect($routingService->path('register', 'get'), $request);
            return;
        }

        $repo = new UserRepository();
        $user = $repo->findByName($request->post['account']);

        if(isset($user)) {
            unset($request->post['password']);
            unset($request->post['confirmation_password']);
            $routingService->redirect($routingService->path('register', 'get'), $request);
            return;
        }

        $user = new User();
        $user->setEmail($request->post['email']);
        $user->setName($request->post['account']);
        $user->setPassword($request->post['password']);
        $user->setRole('ROLE_STUDENT');

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        header('Location: ' . $routingService->path('home'));
    }

    public function toto(Request $request)
    {
        $this->render('UserBundle/Registration/index.html.twig', array(
            'name' => 'Quentin'
        ));
    }
}