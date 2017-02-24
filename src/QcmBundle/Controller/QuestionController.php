<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 17:20
 */

namespace QcmBundle\Controller;

use App\Controller\Controller;
use App\Request;
use App\Service\RoutingService;
use QcmBundle\Entity\Question;
use QcmBundle\Entity\Topic;
use QcmBundle\Type\ReplyType;

class QuestionController extends Controller
{
    /**
     * @param Request $request
     * @param $params
     */
    public function show(Request $request, $params)
    {
        $this->requireRole('TEACHER');

        /** @var RoutingService $routing */
        $routing = $this->get('routing');

        if(!isset($params['topic_id']) || !isset($params['question_id'])) {
            header('Location: ' . $routing->path('topics', 'get'));
        }

        $question = $this->entityManager->find('\QcmBundle\Entity\Question', $params['question_id']);

        if (!isset($question)) {
            header('Location: ' . $routing->path('topics', 'get'));
        }

        if ($question->getTopic()->getId() != $params['topic_id']) {
            header('Location: ' . $routing->path('topics', 'get'));
        }

        $form = new ReplyType();
        $this->createForm(ReplyType::class, $form);

        $this->render(
            'QcmBundle/Question/show.html.twig',
            array(
                'question' => $question,
                'form' => $form
            )
        );
    }

    /**
     * Create a new question for the specified topic (in path)
     *
     * @param Request $request
     * @param $params
     */
    public function create(Request $request, $params)
    {
        $this->requireRole('TEACHER');

        if (!isset($params['topic_id'])) {
            header('Location: /topics');
        }

        /** @var Topic $topic */
        $topic = $this->entityManager->find('\QcmBundle\Entity\Topic', $params['topic_id']);

        if (!isset($topic)) {
            header('Location: /topics');
        }

        $description = $request->post['description'];

        if (!isset($description)) {
            header('Location: /topic/' . $topic->getId());
        }

        $user = $this->get('session-manager')->getCurrentUser();

        $question = new Question();
        $question->setAuthor($user);
        $question->setDescription($description);
        $question->setTopic($topic);

        $this->entityManager->persist($question);
        $this->entityManager->flush();

        header('Location: /topic/' . $topic->getId());
    }
}