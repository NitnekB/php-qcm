<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 24/02/2017
 * Time: 01:18
 */

namespace QcmBundle\Controller;

use App\Controller\Controller;
use App\Request;
use App\Service\RoutingService;
use QcmBundle\Entity\QcmRepository;
use QcmBundle\Entity\Reply;
use UserBundle\Service\SessionManager;

class StudentQcmController extends Controller
{
    /**
     * @param Request $request
     * @param $params
     */
    public function index(Request $request, $params)
    {
        $this->requireRole('STUDENT');

        $repo = new QcmRepository();
        $qcms = $repo->findAll();

        $this->render(
            'QcmBundle/StudentQcm/index.html.twig',
            array(
                'qcms' => $qcms
            )
        );
    }

    /**
     * @param Request $request
     * @param $params
     */
    public function show(Request $request, $params)
    {
        $this->requireRole('STUDENT');

        /** @var RoutingService $routing */
        $routing = $this->get('routing');

        /** @var SessionManager $sm */
        $sm = $this->get('session-manager');

        $user = $sm->getCurrentUser();

        if (!isset($params['id'])) {
            header('Location: ' . $routing->path('student_qcms'));
        }

        $qcm = $this->entityManager->find('\QcmBundle\Entity\Qcm', $params['id']);

        if ($user->getQcmsCompleted()->contains($qcm)) {
            header('Location: ' . $routing->path('student_qcms'));
        }

        $currentQuention = null;

        foreach ($qcm->getQuestions() as $question) {
            $alreadyAnswer = false;

            /** @var Reply $reply */
            foreach ($user->getReplies() as $reply) {
                if($reply->getQuestion() == $question) {
                    $alreadyAnswer = true;
                    break;
                }
            }

            if(!$alreadyAnswer) {
                $currentQuention = $question;
                break;
            }
        }

        if($currentQuention == null) {
            $user->addQcmCompleted($qcm);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            header('Location: ' . $routing->path('student_qcms'));
        }

        $this->render(
            'QcmBundle/StudentQcm/show.html.twig',
            array(
                'qcm' => $qcm,
                'question' => $currentQuention
            )
        );
    }

    /**
     * @param Request $request
     * @param $params
     */
    public function response(Request $request, $params)
    {
        $this->requireRole('STUDENT');

        /** @var RoutingService $routing */
        $routing = $this->get('routing');

        /** @var SessionManager $sm */
        $sm = $this->get('session-manager');

        $user = $sm->getCurrentUser();

        if (!isset($params['id']) || !isset($params['reply_id']) || !isset($params['question_id'])) {
            header('Location: ' . $routing->path('student_qcms'));
        }

        $qcm = $this->entityManager->find('\QcmBundle\Entity\Qcm', $params['id']);
        $question = $this->entityManager->find('\QcmBundle\Entity\Question', $params['question_id']);
        $reply = $this->entityManager->find('\QcmBundle\Entity\Reply', $params['reply_id']);

        if(!isset($qcm) || !isset($question) || !isset($reply)) {
            header('Location: ' . $routing->path('student_qcms'));
        }

        if (
            !$qcm->getQuestions()->contains($question)
            || $reply->getQuestion() != $question
        ) {
            header('Location: ' . $routing->path('student_qcms'));
        }

        $user->addReply($reply);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        header('Location: ' . $routing->path('student_qcm', 'get', array('id' => $qcm->getId())));
    }
}