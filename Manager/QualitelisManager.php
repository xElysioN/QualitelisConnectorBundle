<?php

/*
 * This file is part of the Qualitelis Connector Bundle
 *
 * (c) Maxime Cornet <https://github.com/xelysion/qualitelis-connector-bundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elysion\QualitelisConnectorBundle\Manager;

use Doctrine\Common\Collections\ArrayCollection;
use Elysion\QualitelisConnectorBundle\Denormalizer\AllPrestatairesDenormalizer;
use Elysion\QualitelisConnectorBundle\Denormalizer\PrestataireDenormalizer;
use Elysion\QualitelisConnectorBundle\Exception\InvalidIdContractorException;
use Elysion\QualitelisConnectorBundle\Exception\InvalidTokenException;
use Elysion\QualitelisConnectorBundle\Model\Prestataire;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * Class QualitelisManager.
 *
 * @author  Maxime Cornet <mcornet@altima-agency.com>
 */
final class QualitelisManager
{
    const ALL_PRESTA_GROUP_URL = 'http://www.qualitelis-survey.com/api/Comments/AllPrestaGroup';
    const GROUP_URL = 'http://www.qualitelis-survey.com/api/Comments/Group';

    /** @var Client $client */
    private $client;

    /** @var array $options */
    private $options = [];

    /** @var PrestataireDenormalizer $prestataireDenormalizer */
    private $prestataireDenormalizer;

    /** @var AllPrestatairesDenormalizer $allPrestataireDenormalizer */
    private $allPrestataireDenormalizer;

    /** @var string $prestataireClass */
    private $prestataireClass;

    /** @var string $commentClass */
    private $commentClass;

    /**
     * QualitelisManager constructor.
     *
     * @param PrestataireDenormalizer     $prestataireDenormalizer
     * @param AllPrestatairesDenormalizer $allPrestataireDenormalizer
     * @param string                      $prestataireClass
     * @param string                      $commentClass
     */
    public function __construct(
        PrestataireDenormalizer $prestataireDenormalizer,
        AllPrestatairesDenormalizer $allPrestataireDenormalizer,
        $prestataireClass,
        $commentClass
    ) {
        $this->client = new Client();
        $this->prestataireDenormalizer = $prestataireDenormalizer;
        $this->allPrestataireDenormalizer = $allPrestataireDenormalizer;
        $this->prestataireClass = $prestataireClass;
        $this->commentClass = $commentClass;
    }

    /**
     * Add query in options.
     *
     * @param string          $parameter Name of Query Parameter
     * @param string|string[] $value     Value of Query Parameter
     */
    public function addQuery($parameter, $value)
    {
        if (is_array($value)) {
            $value = implode(',', $value);
        }

        $this->options['query'][$parameter] = $value;
    }

    /**
     * Remove parameter in options.
     *
     * @param string $parameter
     */
    public function removeQuery($parameter)
    {
        unset($this->options[$parameter]);
    }

    /**
     * Add Token and IdGroupe to Query's List.
     *
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->addQuery('Token', $config['token']);
        $this->addQuery('IdGroupe', $config['group_id']);
    }

    /**
     * Add two languages parameters to the query list.
     *
     * @param array|string $lang
     * @param array|string $visitorLanguage
     */
    private function addLanguage($lang = 'EN', $visitorLanguage = 'all')
    {
        $this->addQuery('Langue', $lang);
        $this->addQuery('VisitorLanguage', $visitorLanguage);
    }

    /**
     * Call Qualitelis API to get comments and notes from one prestataire.
     *
     * @param array|string $lang            Interface Language
     * @param array|string $visitorLanguage Visitor Languages
     * @param int          $idContractor    IdContractor
     *
     * @return Prestataire
     */
    public function getPrestataire($lang, $visitorLanguage, $idContractor)
    {
        $this->addLanguage($lang, $visitorLanguage);
        $this->addQuery('IdContractor', $idContractor);
        $json = $this->getJson(self::GROUP_URL);

        return $this->denormalizePrestataire($json, $idContractor);
    }

    /**
     * Call Qualitelis API to get comments and notes from all prestataire.
     *
     * @param array|string $lang            Interface Language
     * @param array|string $visitorLanguage Visitor Languages
     *
     * @return ArrayCollection<Prestataire>
     */
    public function getAllPrestaires($lang, $visitorLanguage)
    {
        $this->addLanguage($lang, $visitorLanguage);
        $json = $this->getJson(self::ALL_PRESTA_GROUP_URL);

        return $this->denormalizePrestataire($json);
    }

    /**
     * Call Prestataire Denormalizer.
     *
     * @param string   $json
     * @param int|null $idContractor
     *
     * @return Prestataire|ArrayCollection<Prestataire>
     */
    public function denormalizePrestataire($json, $idContractor = null)
    {
        $encoders = [new JsonEncoder()];
        $context = [];
        if ($idContractor) {
            $normalizers = [$this->prestataireDenormalizer];
            $type = $this->prestataireClass;
            $context['idContractor'] = $idContractor;
        } else {
            $normalizers = [$this->allPrestataireDenormalizer];
            $type = $this->prestataireClass.'[]';
        }
        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->deserialize(
            $json,
            $type,
            'json',
            $context
        );
    }

    /**
     * Call a get request to a specific url.
     *
     * @param string $url
     *
     * @throws InvalidIdContractorException
     * @throws InvalidTokenException
     * @throws \Exception
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function get($url)
    {
        try {
            /** @var \Psr\Http\Message\ResponseInterface $response */
            $response = $this->client->get(
                $url,
                $this->options
            );
        } catch (RequestException $e) {
            switch ($e->getCode()) {
                case 400:
                    throw new InvalidTokenException('Token is invalid');
                    break;
                case 500:
                    throw new InvalidIdContractorException('IdContractor is invalid');
                    break;
                default:
                    throw new \Exception($e->getMessage());
            }
        }

        return $response;
    }

    /**
     * @param string $url
     *
     * @return null|string
     */
    private function getJson($url)
    {
        $response = $this->get($url);

        return ($body = $response->getBody()) ? $body->getContents() : null;
    }
}
