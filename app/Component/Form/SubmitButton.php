<?php
/**
 * Created by PhpStorm.
 * User: alexandrelepretre
 * Date: 23/02/2017
 * Time: 08:48
 */

namespace App\Component\Form;


class SubmitButton
{
    /**
     * @var string
     */
    private $label;

    /**
     * SubmitButton constructor.
     * @param string $label
     */
    public function __construct(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }


}