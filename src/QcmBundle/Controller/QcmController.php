<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 20:01
 */

namespace QcmBundle\Controller;


use App\Controller\Controller;
use App\Request;
use App\Service\RoutingService;
use QcmBundle\Entity\Qcm;
use QcmBundle\Entity\QcmRepository;
use QcmBundle\Entity\TopicRepository;
use QcmBundle\Type\QcmType;

class QcmController extends Controller
{
    /**
     * @param Request $request
     * @param $params
     */
    public function index(Request $request, $params)
    {
        $repo = new QcmRepository();
        $qcms = $repo->findAll();

        $this->render(
            'QcmBundle/Qcm/index.html.twig',
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
        /** @var RoutingService $routing */
        $routing = $this->get('routing');

        if (!isset($params['id'])) {
            header('Location: ' . $routing->path('qcms'));
        }

        $qcm = $this->entityManager->find('\QcmBundle\Entity\Qcm', $params['id']);

        $this->render(
            'QcmBundle/Qcm/show.html.twig',
            array(
                'qcm' => $qcm
            )
        );
    }

    /**
     * @param Request $request
     * @param $params
     */
    public function newQcm(Request $request, $params)
    {
        $this->requireRole('TEACHER');

        $form = new QcmType();
        $this->createForm(QcmType::class, $form);

        $this->render(
            'QcmBundle/Qcm/new.html.twig',
            array(
                'form' => $form
            )
        );
    }

    /**
     * @param Request $request
     * @param $params
     */
    public function create(Request $request, $params)
    {
        $this->requireRole('TEACHER');

        /** @var RoutingService $routing */
        $routing = $this->get('routing');

        if (!isset($request->post['description']) || !isset($request->post['difficulty'])) {
            header('Location: ' . $routing->path('new_qcm'));
        }

        $qcm = new Qcm();
        $qcm->setDescription($request->post['description']);
        $qcm->setDifficulty($request->post['difficulty']);
        $qcm->setAuthor($this->get('session-manager')->getCurrentUser());

        $this->entityManager->persist($qcm);
        $this->entityManager->flush();

        header('Location: ' . $routing->path('qcms'));
    }

    /**
     * @param Request $request
     * @param $params
     */
    public function topics(Request $request, $params)
    {
        $this->requireRole('TEACHER');
        /** @var RoutingService $routing */
        $routing = $this->get('routing');

        if (!isset($params['qcm_id'])) {
            header('Location: ' . $routing->path('qcms'));
        }

        $qcm = $this->entityManager->find('\QcmBundle\Entity\Qcm', $params['qcm_id']);

        $repo = new TopicRepository();
        $topics = $repo->findAll();

        $this->render(
            'QcmBundle/Qcm/topics.html.twig',
            array(
                'topics' => $topics,
                'qcm' => $qcm
            )
        );
    }

    /**
     * @param Request $request
     * @param $params
     */
    public function questions(Request $request, $params)
    {
        $this->requireRole('TEACHER');
        /** @var RoutingService $routing */
        $routing = $this->get('routing');

        if (!isset($params['qcm_id'])) {
            header('Location: ' . $routing->path('qcms'));
        }

        if (!isset($params['topic_id'])) {
            header('Location: ' . $routing->path(
                'qcm_topics',
                'get',
                array(
                    'qcm_id' => $params['qcm_id']
                )
            ));
        }

        $qcm = $this->entityManager->find('\QcmBundle\Entity\Qcm', $params['qcm_id']);
        $topic = $this->entityManager->find('\QcmBundle\Entity\Topic', $params['topic_id']);
        $questions = [];

        foreach ($topic->getQuestions() as $question) {
            if(!$qcm->getQuestions()->contains($question)) {
                $questions[] = $question;
            }
        }

        $this->render(
            'QcmBundle/Qcm/questions.html.twig',
            array(
                'qcm' => $qcm,
                'topic' => $topic,
                'questions' => $questions
             )
        );
    }

    /**
     * Add a new question to the qcm
     *
     * @param Request $request
     * @param $params
     */
    public function addQuestion(Request $request, $params)
    {
        $this->requireRole('TEACHER');

        /** @var RoutingService $routing */
        $routing = $this->get('routing');

        /**
         * Check for params
         */
        if (!isset($params['qcm_id'])) {
            header('Location: ' . $routing->path('qcms'));
        }

        if (!isset($params['topic_id'])) {
            header('Location: ' . $routing->path(
                    'qcm_topics',
                    'get',
                    array(
                        'qcm_id' => $params['qcm_id']
                    )
                ));
        }

        if (!isset($params['question_id'])) {
            header('Location: ' . $routing->path(
                    'qcm_questions',
                    'get',
                    array(
                        'qcm_id' => $params['qcm_id'],
                        'topic_id' => $params['topic_id']
                    )
                ));
        }

        /**
         * Load entities
         */
        $question = $this->entityManager->find('\QcmBundle\Entity\Question', $params['question_id']);
        $topic = $this->entityManager->find('\QcmBundle\Entity\Topic', $params['topic_id']);
        $qcm = $this->entityManager->find('\QcmBundle\Entity\Qcm', $params['qcm_id']);


        /**
         * Check entities
         */
        if (!isset($question) || !isset($topic) || !isset($qcm)) {
            header('Location: ' . $routing->path(
                'qcm_questions',
                'get',
                array(
                    'qcm_id' => $params['qcm_id'],
                    'topic_id' => $params['topic_id']
                )
            ));
        }

        if($topic->getQuestions()->contains($question)) {
            $qcm->addQuestion($question);
            $this->entityManager->persist($qcm);
            $this->entityManager->flush();
        }

        header('Location: ' . $routing->path(
            'qcm_questions',
            'get',
            array(
                'qcm_id' => $params['qcm_id'],
                'topic_id' => $params['topic_id']
            )
        ));
    }
}