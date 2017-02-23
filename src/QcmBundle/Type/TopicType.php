<?php

namespace QcmBundle\Type;

use App\Component\Form\AbstractType;
use App\Component\Form\SubmitButton;

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 16:49
 */
class TopicType extends AbstractType
{
    /**
     * @param \App\Component\Form\FormBuilderInterface $builder
     * @return mixed
     */
    public function buildForm(\App\Component\Form\FormBuilderInterface $builder)
    {
        $builder
            ->add('label', 'text', 'Label du topic')
            ->add('submit', SubmitButton::class, 'Enregistrer')
            ->add('create_topic', 'action');

        return $builder->getResult();
    }
}