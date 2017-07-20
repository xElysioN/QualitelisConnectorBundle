<?php

/*
 * This file is part of the Qualitelis Connector Bundle
 *
 * (c) Maxime Cornet <https://github.com/xelysion/qualitelis-connector-bundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elysion\QualitelisConnectorBundle\Denormalizer;

use Doctrine\Common\Collections\ArrayCollection;
use Elysion\QualitelisConnectorBundle\Model\Comment;
use Elysion\QualitelisConnectorBundle\Model\Prestataire;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class AbstractPrestataireDenormalizer.
 *
 * @author Maxime Cornet <xelysion@icloud.com>
 */
abstract class AbstractPrestataireDenormalizer implements DenormalizerInterface
{
    /** @var array $commentAttributes */
    const commentAttributes = [
        'firstName',
        'lastName',
        'stayStart',
        'stayEnd',
        'replyDate',
        'note',
        'comment',
        'commentTitle',
        'pinned',
        'profile1',
        'profile2',
        'profile3',
        'idSejour',
        'replyMail',
        'language',
    ];

    /** @var string $entityClass */
    protected $entityClass;

    /** @var string $commentClass */
    protected $commentClass;

    /** @var array $attributes */
    protected $attributes = [
        'nbAnsweredSurveys',
        'satisfactionAverage',
        'tagResult',
        'qiResult',
        'qiSources',
    ];

    /**
     * PrestataireDenormalizer constructor.
     *
     * @param string $entityClass
     * @param string $commentClass
     */
    public function __construct($entityClass, $commentClass)
    {
        $this->entityClass = $entityClass;
        $this->commentClass = $commentClass;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        /** @var Prestataire $prestataire */
        $prestataire = new $this->entityClass();

        foreach ($this->attributes as $attribute) {
            if (array_key_exists($attribute, $data)) {
                $setter = 'set'.$attribute;
                $prestataire->$setter($data[$attribute]);
            }
        }

        // @TODO use CommentDenormalizer ?
        if (array_key_exists('comments', $data)) {
            /** @var ArrayCollection $comments */
            $comments = $prestataire->getComments();

            foreach ($data['comments'] as $commentArray) {
                $comments->add($this->denormalizeComment($commentArray, $prestataire));
            }
        }

        if (array_key_exists('idContractor', $context)) {
            $prestataire->setIdPrestataire($context['idContractor']);
        }

        return $prestataire;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === $this->entityClass;
    }

    /**
     * Denormalize Comments.
     *
     * @param array       $data
     * @param Prestataire $prestataire
     *
     * @return Comment
     */
    public function denormalizeComment($data, Prestataire $prestataire)
    {
        /** @var Comment $comment */
        $comment = new $this->commentClass();

        $comment->setPrestataire($prestataire);

        /** @var string $attribute */
        foreach (self::commentAttributes as $attribute) {
            if (array_key_exists($attribute, $data)) {
                $setter = 'set'.$attribute;
                $comment->$setter($data[$attribute]);
            }
        }

        return $comment;
    }
}
