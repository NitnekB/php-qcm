<?php

namespace App\Component\Form;

/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 16:30
 */
class FormBuilderInterface
{
    /**
     * @var AbstractType
     */
    private $class;

    /**
     * FormBuilderInterface constructor.
     * @param $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * @param string $name
     * @param mixed $type
     * @param string $label
     * @return $this
     */
    public function add(string $name, $type, string $label = null)
    {
        if($type === SubmitButton::class) {
            $this->class->setSubmit(new SubmitButton($label));
        } elseif($type === "action") {
            $this->class->setAction($name);
        } else {
            $field = new FormField($name, $type, $label);
            $this->class->addField($field);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->class;
    }
}