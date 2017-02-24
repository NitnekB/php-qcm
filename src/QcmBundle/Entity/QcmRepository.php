<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 23:45
 */

namespace QcmBundle\Entity;


use App\Component\Component;

class QcmRepository extends Component
{
    public function findAll()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('q')
            ->from('\QcmBundle\Entity\Qcm', 'q');

        return $qb->getQuery()->getResult();
    }
}