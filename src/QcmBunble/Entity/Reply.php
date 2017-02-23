<?php

namespace QcmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reply
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reply
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="good_one", type="boolean")
     */
    private $good_one;

    /**
     * Many Replies have One Question.
     * @ManyToOne(targetEntity="Question", inversedBy="replies")
     * @JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;
}