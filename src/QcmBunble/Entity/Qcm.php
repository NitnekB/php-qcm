<?php

namespace QcmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Qcm
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Qcm
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
     * @ORM\Column(name="description", type="string", length="150")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="difficulty", type="string", length="50")
     */
    private $difficulty;

    /**
     * Many Users create One Qcm.
     * @ManyToOne(targetEntity="Users")
     * @JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * Many Qcms have Many Questions.
     * @ManyToMany(targetEntity="Question", mappedBy="qcms")
     */
    private $questions;

    public function __construct() {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }
}