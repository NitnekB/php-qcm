<?php

namespace QcmBundle\Controller;

use App\Controller\Controller;

/**
 * Class DefaultController
 * @package QcmBundle\Controller
 */
class DefaultController extends Controller
{
    public function index()
    {
        $this->render('QcmBundle/Default/index.html.twig', array());
    }
}