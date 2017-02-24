<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 23:29
 */

namespace QcmBundle\Type;

use App\Component\Form\AbstractType;
use App\Component\Form\FormBuilderInterface;
use App\Component\Form\SubmitButton;

class QcmType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->add('description', 'text', 'Nom du qcm')
            ->add('difficulty', 'text', 'Difficulté')
            ->add('submit', SubmitButton::class, 'Enregistrer')
            ->add('create_qcm', 'action');

        return $builder->getResult();
    }
}