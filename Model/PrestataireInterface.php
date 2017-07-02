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
     */
    public function setIdPrestataire($idPrestataire);

    /**
     * @return int
     */
    public function getNbAnsweredSurveys();

    /**
     * @param int $nbAnsweredSurveys
     */
    public function setNbAnsweredSurveys($nbAnsweredSurveys);

    /**
     * @return float
     */
    public function getSatisfactionAverage();

    /**
     * @param float $satisfactionAverage
     */
    public function setSatisfactionAverage($satisfactionAverage);

    /**
     * @return ArrayCollection
     */
    public function getComments();

    /**
     * @param ArrayCollection $comments
     */
    public function setComments($comments);

    /**
     * @return array|null
     */
    public function getTagResult();

    /**
     * @param array|null $tagResult
     */
    public function setTagResult($tagResult);

    /**
     * @return array|null
     */
    public function getQiResult();

    /**
     * @param array|null $qiResult
     */
    public function setQiResult($qiResult);

    /**
     * @return array|null
     */
    public function getQiSources();

    /**
     * @param array|null $qiSources
     */
    public function setQiSources($qiSources);
}
