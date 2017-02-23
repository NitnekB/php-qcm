<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="name", type="string", length=150)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=100)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="\QcmBundle\Entity\Qcm", mappedBy="author", cascade={"persist", "remove"})
     */
    private $qcmsCreated;

    /**
     * @ORM\OneToMany(targetEntity="\QcmBundle\Entity\Question", mappedBy="author", cascade={"persist", "remove"})
     */
    private $questions;

    /**
     * @ORM\ManyToMany(targetEntity="\QcmBundle\Entity\Reply", mappedBy="users")
     */
    private $replies;

    private $qcmsParticipated;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->qcmsCreated = new ArrayCollection();
        $this->qcmsParticipated = new ArrayCollection();
        $this->replies = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQcmsCreated()
    {
        return $this->qcmsCreated;
    }

    /**
     * @param ArrayCollection $qcmsCreated
     */
    public function setQcmsCreated($qcmsCreated)
    {
        $this->qcmsCreated = $qcmsCreated;
    }

    /**
     * @return ArrayCollection
     */
    public function getQcmsParticipated()
    {
        return $this->qcmsParticipated;
    }

    /**
     * @param mixed $qcmsParticipated
     */
    public function setQcmsParticipated($qcmsParticipated)
    {
        $this->qcmsParticipated = $qcmsParticipated;
    }

    /**
     * @return mixed
     */
    public function getReplies()
    {
        return $this->replies;
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
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param mixed $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }
}