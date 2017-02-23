<?php

namespace QcmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\UserBundle;

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
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\User", inversedBy="questions")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Topic", inversedBy="questions")
     * @ORM\JoinColumn(name="topic_id", referencedColumnName="id")
     */
    private $topic;

    /**
     * One Question has Many Replies.
     * @ORM\OneToMany(targetEntity="Reply", mappedBy="question")
     */
    private $replies;

    /**
     * Many Questions have Many Qcms.
     * @ORM\ManyToMany(targetEntity="QcmBundle\Entity\Qcm", inversedBy="questions")
     * @ORM\JoinTable(name="questions_qcms")
     */
    private $qcms;

    public function __construct() {
        $this->replies = new ArrayCollection();
        $this->qcms = new ArrayCollection();
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
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param \UserBundle\Entity\User $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        if(!$author->getQuestions()->contains($this)) {
            $author->addQuestion($this);
        }
    }

    /**
     * @return Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    /**
     * @return ArrayCollection
     */
    public function getReplies()
    {
        return $this->replies;
    }

    /**
     * @param Reply $reply
     */
    public function addReply($reply)
    {
        if(!$this->replies->contains($reply)) {
            $this->replies->add($reply);
        }

        if ($reply->getQuestion() != $this) {
            $reply->setQuestion($this);
        }
    }

    /**
     * @param mixed $replies
     */
    public function setReplies($replies)
    {
        $this->replies = $replies;
    }

    /**
     * @return mixed
     */
    public function getQcms()
    {
        return $this->qcms;
    }

    /**
     * @param mixed $qcms
     */
    public function setQcms($qcms)
    {
        $this->qcms = $qcms;
    }
}