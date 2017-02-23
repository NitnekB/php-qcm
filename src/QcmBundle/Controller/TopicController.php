<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 16:44
 */

namespace QcmBundle\Controller;

use App\Controller\Controller;
use App\Request;
use QcmBundle\Entity\Topic;
use QcmBundle\Entity\TopicRepository;
use QcmBundle\Type\QuestionType;
use QcmBundle\Type\TopicType;
use UserBundle\UserBundle;

class TopicController extends Controller
{
    /**
     * Index action for topics
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $repo = new TopicRepository();
        $topics = $repo->findAll();

        $this->render(
            'QcmBundle/Topic/index.html.twig', array(
                'topics' => $topics
            )
        );
    }

    /**
     * Show a topic
     *
     * @param Request $request
     * @param $params
     */
    public function show(Request $request, $params)
    {
        $topic = $this->entityManager->find('\QcmBundle\Entity\Topic', $params['id']);

        if(!isset($topic)) {
            header('Location: /topics');
        }

        $response = [];
        $response['topic'] = $topic;

        if($this->checkRole('TEACHER')) {
            $form = new QuestionType();
            $this->createForm(QuestionType::class, $form);
            $response['form'] = $form;
        }

        $this->render('QcmBundle/Topic/show.html.twig', $response);
    }

    /**
     * Prepare request for create a new topic
     *
     * @param Request $request
     */
    public function newTopic(Request $request)
    {
        $this->requireRole('TEACHER');

        $form = new TopicType();
        $this->createForm(TopicType::class, $form);
        $this->render('QcmBundle/Topic/new.html.twig', array(
            'form' => $form
        ));
    }

    /**
     * Create a new topic
     *
     * @param Request $request
     */
    public function createTopic(Request $request)
    {
        $this->requireRole('TEACHER');

        if(!isset($request->post['label'])) {
            header('Location: /topic/new');
        }

        $topic = new Topic();
        $topic->setLabel($request->post['label']);

        $this->entityManager->persist($topic);
        $this->entityManager->flush();

        header('Location: /topics');
    }
}