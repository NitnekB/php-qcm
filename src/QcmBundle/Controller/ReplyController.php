<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 22:52
 */

namespace QcmBundle\Controller;

use App\Controller\Controller;
use App\Request;
use App\Service\RoutingService;
use QcmBundle\Entity\Reply;

class ReplyController extends Controller
{
    public function create(Request $request, $params)
    {
        $this->requireRole('TEACHER');

        /** @var RoutingService $routing */
        $routing = $this->get('routing');

        if(!isset($params['topic_id']) || !isset($params['question_id'])) {
            header('Location: ' . $routing->path('topics', 'get'));
        }

        if(isset($request->post['description'])) {

            $question = $this->entityManager->find('\QcmBundle\Entity\Question', $params['question_id']);

            if (!isset($question)) {
                header('Location: ' . $routing->path('topics', 'get'));
            }

            if ($question->getTopic()->getId() != $params['topic_id']) {
                header('Location: ' . $routing->path('topics', 'get'));
            }

            $reply = new Reply();
            $reply->setQuestion($question);
            $reply->setGoodOne(isset($request->post['good_one']));
            $reply->setDescription($request->post['description']);

            $this->entityManager->persist($reply);
            $this->entityManager->flush();
        }

        header(
            'Location: ' . $routing->path(
                'question',
                'get', array(
                    'topic_id' => $params['topic_id'],
                    'question_id' => $params['question_id']
                )
            )
        );
    }
}