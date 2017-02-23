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
     * @param $session
     * @return User
     */
    public function getUser($session)
    {
        $userId = $session['user_id'];

        if($userId == null) {
            return null;
        }

        /** @var User $user */
        $user = $this->entityManager->find('User', $session['user_id']);

        return $user;
    }
}