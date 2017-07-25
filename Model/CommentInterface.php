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
 * Interface CommentInterface.
 *
 * @author Maxime Cornet <xelysion@icloud.com>
 */
interface CommentInterface
{
    /**
     * @return string
     */
    public function getFirstname();

    /**
     * @param string $firstname
     *
     * @return $this
     */
    public function setFirstname($firstname);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName($lastName);

    /**
     * @return \DateTime
     */
    public function getStayStart();

    /**
     * @param string $stayStart
     *
     * @return $this
     */
    public function setStayStart($stayStart);

    /**
     * @return \DateTime
     */
    public function getStayEnd();

    /**
     * @param string $stayEnd
     *
     * @return $this
     */
    public function setStayEnd($stayEnd);

    /**
     * @return \DateTime
     */
    public function getReplyDate();

    /**
     * @param string $replyDate
     *
     * @return $this
     */
    public function setReplyDate($replyDate);

    /**
     * @return int
     */
    public function getNote();

    /**
     * @param int $note
     *
     * @return $this
     */
    public function setNote($note);

    /**
     * @return string
     */
    public function getComment();

    /**
     * @param string $comment
     *
     * @return $this
     */
    public function setComment($comment);

    /**
     * @return string
     */
    public function getCommentTitle();

    /**
     * @param string $commentTitle
     *
     * @return $this
     */
    public function setCommentTitle($commentTitle);

    /**
     * @return bool
     */
    public function isPinned();

    /**
     * @param bool $pinned
     *
     * @return $this
     */
    public function setPinned($pinned);

    /**
     * @return string
     */
    public function getProfile1();

    /**
     * @param string $profile1
     *
     * @return $this
     */
    public function setProfile1($profile1);

    /**
     * @return string
     */
    public function getProfile2();

    /**
     * @param string $profile2
     *
     * @return $this
     */
    public function setProfile2($profile2);

    /**
     * @return string
     */
    public function getProfile3();

    /**
     * @param string $profile3
     *
     * @return $this
     */
    public function setProfile3($profile3);

    /**
     * @return string
     */
    public function getIdSejour();

    /**
     * @param string $idSejour
     *
     * @return $this
     */
    public function setIdSejour($idSejour);

    /**
     * @return array|null
     */
    public function getReplyMail();

    /**
     * @param array|null $replyMail
     *
     * @return $this
     */
    public function setReplyMail($replyMail);

    /**
     * @return PrestataireInterface
     */
    public function getPrestataire();

    /**
     * @param PrestataireInterface $prestataire
     *
     * @return $this
     */
    public function setPrestataire($prestataire);
}
