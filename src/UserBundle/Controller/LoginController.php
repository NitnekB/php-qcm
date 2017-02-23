<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 15:33
 */

namespace UserBundle\Controller;

use App\Controller\Controller;
use App\Request;
use App\Service\RoutingService;
use UserBundle\Entity\UserRepository;
use UserBundle\FormType\LoginType;
use UserBundle\Service\SessionManager;

class LoginController extends Controller
{
    /**
     * Get method : display the login form
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        if($this->get("session-manager")->getCurrentUser()) {
            header('Location: /');
            return;
        }

        $form = new LoginType();
        $this->createForm(LoginType::class, $form);

        $this->render('UserBundle/Login/index.html.twig',
            array('form' => $form)
        );
    }

    /**
     * Handle post for login
     *
     * @param Request $request
     */
    public function create(Request $request)
    {
        $request->setMethod('get');

        $account = $request->post['account'];
        $password = $request->post['password'];

        /** @var RoutingService $router */
        $router = $this->get('routing');

        if (!isset($account) || !isset($password)) {
            $router->redirect($router->path('login'), $request);
        }

        $repo = new UserRepository();
        $user = $repo->findBy($account, $password);

        if(!isset($user)) {
            $router->redirect($router->path('login'), $request);
        } else {
            /** @var SessionManager $sm */
            $sm = $this->get('session-manager');
            $sm->setUser($user);
        }

        header('Location: /');
    }

    /**
     * logout the user
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        unset($_SESSION['user_id']);
        header('Location: /');
    }
}