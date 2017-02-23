<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 22:37
 */

namespace QcmBundle\Type;


use App\Component\Form\AbstractType;
use App\Component\Form\FormBuilderInterface;
use App\Component\Form\SubmitButton;

class ReplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('description', 'text', 'Réponse')
            ->add('good_one', 'checkbox', 'Est une bonne réponse')
            ->add('submit', SubmitButton::class, 'Enregistrer')
            ->add('create_reply', 'action');

        return $builder->getResult();
    }
}