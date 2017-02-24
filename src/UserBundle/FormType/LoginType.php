<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 15:40
 */

namespace UserBundle\FormType;

use App\Component\Form\AbstractType;
use App\Component\Form\FormBuilderInterface;
use App\Component\Form\SubmitButton;

class LoginType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('account', 'text', 'Nom de compte')
            ->add('password', 'password', 'Mot de passe')
            ->add('submit', SubmitButton::class, 'Se connecter')
            ->add('login_post', 'action');

        return $builder->getResult();
    }
}