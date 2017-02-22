<?php

namespace UserBundle\FormType;

use App\Component\Form\AbstractType;
use App\Component\Form\FormBuilderInterface;

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 16:25
 */
class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('account', 'text', 'Nom de compte')
            ->add('password', 'password' , 'Mot de passe');

        return $builder->getResult();
    }
}