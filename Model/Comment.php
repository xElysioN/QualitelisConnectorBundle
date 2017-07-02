<?php

/*
 * This file is part of the Qualitelis Connector Bundle
 *
 * (c) Maxime Cornet <https://github.com/xelysion/qualitelis-connector-bundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elysion\QualitelisConnectorBundle\Model;

/**
 * Class Comment.
 *
 * @author Maxime Cornet <mcornet@altima-agency.com>
 */
class Comment implements CommentInterface
{
    /** @var string $firstname */
    protected $firstname;

    /** @var string $lastName */
    protected $lastName;

    /** @var \DateTime $stayStart */
    protected $stayStart;

    /** @var \DateTime $stayEnd */
    protected $stayEnd;

    /** @var \DateTime $replyDate */
    protected $replyDate;

    /** @var int $note */
    protected $note;

    /** @var string $comment */
    protected $comment;

    /** @var string $commentTitle */
    protected $commentTitle;

    /** @var bool $pinned */
    protected $pinned;

    /** @var string $profile1 */
    protected $profile1;

    /** @var string $profile2 */
    protected $profile2;

    /** @var string $profile3 */
    protected $profile3;

    /** @var string $idSejour */
    protected $idSejour;

    /** @var string|null $replyMail */
    protected $replyMail;

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return \DateTime
     */
    public function getStayStart()
    {
        return $this->stayStart;
    }

    /**
     * @param string $stayStart
     */
    public function setStayStart($stayStart)
    {
        $this->stayStart = \DateTime::createFromFormat('d/m/Y', $stayStart);
    }

    /**
     * @return \DateTime
     */
    public function getStayEnd()
    {
        return $this->stayEnd;
    }

    /**
     * @param string $stayEnd
     */
    public function setStayEnd($stayEnd)
    {
        $this->stayEnd = \DateTime::createFromFormat('d/m/Y', $stayEnd);
    }

    /**
     * @return \DateTime
     */
    public function getReplyDate()
    {
        return $this->replyDate;
    }

    /**
     * @param string $replyDate
     */
    public function setReplyDate($replyDate)
    {
        $this->replyDate = \DateTime::createFromFormat('d/m/Y', $replyDate);
    }

    /**
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param int $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getCommentTitle()
    {
        return $this->commentTitle;
    }

    /**
     * @param string $commentTitle
     */
    public function setCommentTitle($commentTitle)
    {
        $this->commentTitle = $commentTitle;
    }

    /**
     * @return bool
     */
    public function isPinned()
    {
        return $this->pinned;
    }

    /**
     * @param bool $pinned
     */
    public function setPinned($pinned)
    {
        $this->pinned = $pinned;
    }

    /**
     * @return string
     */
    public function getProfile1()
    {
        return $this->profile1;
    }

    /**
     * @param string $profile1
     */
    public function setProfile1($profile1)
    {
        $this->profile1 = $profile1;
    }

    /**
     * @return string
     */
    public function getProfile2()
    {
        return $this->profile2;
    }

    /**
     * @param string $profile2
     */
    public function setProfile2($profile2)
    {
        $this->profile2 = $profile2;
    }

    /**
     * @return string
     */
    public function getProfile3()
    {
        return $this->profile3;
    }

    /**
     * @param string $profile3
     */
    public function setProfile3($profile3)
    {
        $this->profile3 = $profile3;
    }

    /**
     * @return string
     */
    public function getIdSejour()
    {
        return $this->idSejour;
    }

    /**
     * @param string $idSejour
     */
    public function setIdSejour($idSejour)
    {
        $this->idSejour = $idSejour;
    }

    /**
     * @return array|null
     */
    public function getReplyMail()
    {
        return json_decode($this->replyMail, true);
    }

    /**
     * @param array|null $replyMail
     */
    public function setReplyMail($replyMail)
    {
        $this->replyMail = json_encode($replyMail);
    }
}
