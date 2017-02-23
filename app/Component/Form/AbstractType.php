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
    private $submit;
    private $action;

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

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return mixed
     */
    public function getSubmit()
    {
        return $this->submit;
    }

    /**
     * @param mixed $submit
     */
    public function setSubmit($submit)
    {
        $this->submit = $submit;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }
}