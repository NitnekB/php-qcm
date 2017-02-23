<?php

namespace QcmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Question
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
     * Many Users create One Question.
     * @ManyToOne(targetEntity="Users")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @OneToOne(targetEntity="Topic")
     * @JoinColumn(name="topic_id", referencedColumnName="id")
     */
    private $topic;

    /**
     * One Question has Many Replies.
     * @OneToMany(targetEntity="Reply", mappedBy="question")
     */
    private $replies;

    /**
     * Many Questions have Many Qcms.
     * @ManyToMany(targetEntity="Qcm", inversedBy="questions")
     * @JoinTable(name="questions_qcms")
     */
    private $qcms;

    public function __construct() {
        $this->replies = new ArrayCollection();
        $this->qcms = new \Doctrine\Common\Collections\ArrayCollection();
    }
}