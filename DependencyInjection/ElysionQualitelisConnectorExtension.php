<?php

/*
 * This file is part of the Qualitelis Connector Bundle
 *
 * (c) Maxime Cornet <https://github.com/xelysion/qualitelis-connector-bundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elysion\QualitelisConnectorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class ElysionQualitelisConnectorExtension.
 *
 * @author Maxime Cornet <mcornet@altima-agency.com>
 */
class ElysionQualitelisConnectorExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('denormalizers.yml');

        $qualitelisDefinition = $container->getDefinition('elysion.qualitelis.manager');
        $qualitelisDefinition->addMethodCall('setConfig', [$config]);
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'qualitelis';
    }
}
