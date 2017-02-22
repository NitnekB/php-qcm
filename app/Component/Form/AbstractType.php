<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 22/02/2017
 * Time: 16:39
 */

namespace App\Component\Form;

abstract class AbstractType
{
    private $fields;

    public abstract function buildForm(FormBuilderInterface $builder);

    /**
     * Add a new field to the form
     *
     * @param FormField $field
     */
    public function addField(FormField $field)
    {
        $this->fields[$field->getName()] = $field;
    }

    /**
     * @param string $fieldName
     * @return mixed
     */
    public function get(string $fieldName)
    {
        return $this->fields[$fieldName];
    }
}