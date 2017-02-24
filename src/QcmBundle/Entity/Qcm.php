<?php

namespace QcmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(name="description", type="string", length=150)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="difficulty", type="string", length=50)
     */
    private $difficulty;

    /**
     * Many Users create One Qcm.
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="qcmsCreated")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * Many Qcms have Many Questions.
     * @ORM\ManyToMany(targetEntity="Question", mappedBy="qcms")
     */
    private $questions;

    public function __construct() {
        $this->questions = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return string
     */
    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    /**
     * @param string $difficulty
     */
    public function setDifficulty(string $difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return ArrayCollection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param Question $question
     */
    public function addQuestion($question)
    {
        if(!$this->questions->contains($question)) {
            $this->questions->add($question);
        }

        if(!$question->getQcms()->contains($this)) {
            $question->addQcm($this);
        }
    }

    /**
     * @param mixed $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    /**
     * @return mixed
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param mixed $student
     */
    public function setStudents($students)
    {
        $this->students = $students;
    }
}