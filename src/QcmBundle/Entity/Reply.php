<?php

namespace QcmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     *
     * @var Question
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="replies")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", inversedBy="replies")
     * @ORM\JoinTable(name="users_replies")
     */
    private $users;

    /**
     * Reply constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function isGoodOne(): bool
    {
        return $this->good_one;
    }

    /**
     * @param bool $good_one
     */
    public function setGoodOne(bool $good_one)
    {
        $this->good_one = $good_one;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param Question $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        if(!$this->question->getReplies()->contains($this)) {
            $this->question->addReply($this);
        }
    }
}