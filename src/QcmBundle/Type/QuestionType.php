<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 18:34
 */

namespace QcmBundle\Type;


use App\Component\Form\AbstractType;
use App\Component\Form\FormBuilderInterface;
use App\Component\Form\SubmitButton;

class QuestionType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('description', 'text', 'Ennoncé')
            ->add('submit', SubmitButton::class, 'Enregistrer')
            ->add('create_question', 'action');

        return $builder->getResult();
    }
}