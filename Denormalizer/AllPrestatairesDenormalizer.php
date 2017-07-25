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
use Elysion\QualitelisConnectorBundle\Model\Prestataire;

/**
 * Class AllPrestatairesDenormalizer.
 *
 * @author Maxime Cornet <xelysion@icloud.com>
 */
class AllPrestatairesDenormalizer extends AbstractPrestataireDenormalizer
{
    /**
     * {@inheritdoc}
     */
    public function __construct($entityClass, $commentClass)
    {
        parent::__construct($entityClass, $commentClass);
        $this->attributes[] = 'idPrestataire';
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $obj = new ArrayCollection();

        foreach ($data as $row) {
            $prestataire = new $this->entityClass();
            $col = $row['prestataire'];

            foreach ($this->attributes as $attribute) {
                if (array_key_exists($attribute, $col)) {
                    $setter = 'set'.$attribute;
                    $prestataire->$setter($col[$attribute]);
                }
            }

            // @TODO use CommentDenormalizer ?
            if (array_key_exists('comments', $col)) {
                /** @var ArrayCollection $comments */
                $comments = $prestataire->getComments();

                foreach ($col['comments'] as $commentArray) {
                    $comments->add($this->denormalizeComment($commentArray, $prestataire));
                }
            }

            $obj->add($prestataire);
        }

        return $obj;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === ($this->entityClass.'[]');
    }
}
