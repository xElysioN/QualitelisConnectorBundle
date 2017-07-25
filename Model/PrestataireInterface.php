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

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface PrestataireInterface.
 *
 * @author Maxime Cornet <xelysion@icloud.com>
 */
interface PrestataireInterface
{
    /**
     * @return int
     */
    public function getIdPrestataire();

    /**
     * @param int $idPrestataire
     *
     * @return $this
     */
    public function setIdPrestataire($idPrestataire);

    /**
     * @return int
     */
    public function getNbAnsweredSurveys();

    /**
     * @param int $nbAnsweredSurveys
     *
     * @return $this
     */
    public function setNbAnsweredSurveys($nbAnsweredSurveys);

    /**
     * @return float
     */
    public function getSatisfactionAverage();

    /**
     * @param float $satisfactionAverage
     *
     * @return $this
     */
    public function setSatisfactionAverage($satisfactionAverage);

    /**
     * @return ArrayCollection
     */
    public function getComments();

    /**
     * @param ArrayCollection $comments
     *
     * @return $this
     */
    public function setComments($comments);

    /**
     * @param CommentInterface $comment
     *
     * @return $this
     */
    public function addComment(CommentInterface $comment);

    /**
     * @param CommentInterface $comment
     *
     * @return $this
     */
    public function removeComment(CommentInterface $comment);

    /**
     * @return array|null
     */
    public function getTagResult();

    /**
     * @param array|null $tagResult
     *
     * @return $this
     */
    public function setTagResult($tagResult);

    /**
     * @return array|null
     */
    public function getQiResult();

    /**
     * @param array|null $qiResult
     *
     * @return $this
     */
    public function setQiResult($qiResult);

    /**
     * @return array|null
     */
    public function getQiSources();

    /**
     * @param array|null $qiSources
     *
     * @return $this
     */
    public function setQiSources($qiSources);
}
