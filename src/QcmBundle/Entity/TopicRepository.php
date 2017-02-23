<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 16:45
 */

namespace QcmBundle\Entity;


use App\Component\Component;

class TopicRepository extends Component
{
    /**
     * Get all topics
     *
     * @return array
     */
    public function findAll()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('t')
            ->from('\QcmBundle\Entity\Topic', 't');

        return $qb->getQuery()->getResult();
    }
}