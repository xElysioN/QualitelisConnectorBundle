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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Validator\Constraints\Uuid as UuidConstraint;
use Symfony\Component\Validator\Validation;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('qualitelis')->isRequired();
        $rootNode
            ->children()
            ->scalarNode('token')
            ->info('Qualitelis Token.')
            ->isRequired()
            ->cannotBeEmpty()
            ->validate()
            ->ifTrue(
                function ($uuid) {
                    $validator = Validation::createValidator();
                    $uuidConstraint = new UuidConstraint();

                    $violations = $validator->validate(
                        $uuid,
                        $uuidConstraint
                    );

                    return 0 !== count($violations);
                }
            )
            ->thenInvalid('Token must be UUID')
            ->end()
            ->end()
            ->integerNode('group_id')
            ->isRequired()
            ->info('Qualitelis Group Id.')
            ->end()
            ->end();

        return $treeBuilder;
    }
}
