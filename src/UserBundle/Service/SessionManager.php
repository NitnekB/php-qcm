<?php

namespace UserBundle\Service;

use App\Component\Component;
use UserBundle\Entity\User;

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 13:40
 */
class SessionManager extends Component
{
    /**
     * @return User
     */
    public function getCurrentUser()
    {
        if(!isset($_SESSION['user_id'])) {
            return null;
        }

        $userId = $_SESSION['user_id'];

        /** @var User $user */
        $user = $this->entityManager->find('\UserBundle\Entity\User', $userId);

        return $user;
    }

    /**
     * @param \UserBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $_SESSION['user_id'] = $user->getId();
    }
}