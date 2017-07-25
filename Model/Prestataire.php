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
 * Class Prestataire.
 *
 * @author Maxime Cornet <xelysion@icloud.com>
 */
class Prestataire implements PrestataireInterface
{
    /** @var int $idPrestataire */
    protected $idPrestataire;

    /** @var int $nbAnsweredSurveys */
    protected $nbAnsweredSurveys;

    /** @var float $satisfactionAverage */
    protected $satisfactionAverage;

    /** @var ArrayCollection $comments */
    protected $comments;

    /** @var string $tagResult */
    protected $tagResult;

    /** @var string $qiResult */
    protected $qiResult;

    /** @var string $qiSources */
    protected $qiSources;

    /**
     * Prestataire constructor.
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIdPrestataire()
    {
        return $this->idPrestataire;
    }

    /**
     * @param int $idPrestataire
     *
     * @return $this
     */
    public function setIdPrestataire($idPrestataire)
    {
        $this->idPrestataire = $idPrestataire;

        return $this;
    }

    /**
     * @return int
     */
    public function getNbAnsweredSurveys()
    {
        return $this->nbAnsweredSurveys;
    }

    /**
     * @param int $nbAnsweredSurveys
     *
     * @return $this
     */
    public function setNbAnsweredSurveys($nbAnsweredSurveys)
    {
        $this->nbAnsweredSurveys = $nbAnsweredSurveys;

        return $this;
    }

    /**
     * @return float
     */
    public function getSatisfactionAverage()
    {
        return $this->satisfactionAverage;
    }

    /**
     * @param float $satisfactionAverage
     *
     * @return $this
     */
    public function setSatisfactionAverage($satisfactionAverage)
    {
        $this->satisfactionAverage = $satisfactionAverage;

        return $this;
    }

    /**
     * @return ArrayCollection<Comment>
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param ArrayCollection $comments
     *
     * @return $this
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * @param CommentInterface $comment
     *
     * @return $this
     */
    public function addComment(CommentInterface $comment)
    {
        $comment->setPrestataire($this);
        $this->comments->add($comment);

        return $this;
    }

    /**
     * @param CommentInterface $comment
     *
     * @return $this
     */
    public function removeComment(CommentInterface $comment)
    {
        $comment->setPrestataire($this);
        $this->comments->remove($comment);

        return $this;
    }

    /**
     * @return array|null
     */
    public function getTagResult()
    {
        return json_decode($this->tagResult, true);
    }

    /**
     * @param array|null $tagResult
     *
     * @return $this
     */
    public function setTagResult($tagResult)
    {
        $this->tagResult = json_encode($tagResult);

        return $this;
    }

    /**
     * @return array|null
     */
    public function getQiResult()
    {
        return json_decode($this->qiResult, true);
    }

    /**
     * @param array|null $qiResult
     *
     * @return $this
     */
    public function setQiResult($qiResult)
    {
        $this->qiResult = json_encode($qiResult);

        return $this;
    }

    /**
     * @return array|null
     */
    public function getQiSources()
    {
        return json_decode($this->qiSources, true);
    }

    /**
     * @param array|null $qiSources
     *
     * @return $this
     */
    public function setQiSources($qiSources)
    {
        $this->qiSources = json_encode($qiSources);

        return $this;
    }
}
