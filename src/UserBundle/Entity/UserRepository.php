<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 15:48
 */

namespace UserBundle\Entity;


use App\Component\Component;

class UserRepository extends Component
{
    /**
     * @param string $account
     * @return \UserBundle\Entity\User
     */
    public function findByName(string $account)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('u')
            ->from('\UserBundle\Entity\User', 'u')
            ->where('u.name = :account');

        $qb->setParameter('account', $account);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param string $account
     * @param $password
     * @return \UserBundle\Entity\User
     */
    public function findBy(string $account, $password)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('u')
            ->from('\UserBundle\Entity\User', 'u')
            ->where('u.name = :account')
            ->andWhere('u.password = :password');

        $qb->setParameter('account', $account);
        $qb->setParameter('password', $password);

        return $qb->getQuery()->getOneOrNullResult();
    }
}