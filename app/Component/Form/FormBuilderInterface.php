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
     * @param string|null $type
     * @param string $label
     * @return $this
     */
    public function add(string $name, string $type = null, string $label = null)
    {
        $field = new FormField($name, $type, $label);

        $this->class->addField($field);

        return $this;
    }

    public function getResult()
    {
        return $this->class;
    }
}