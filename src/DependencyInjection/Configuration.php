<?php

declare(strict_types=1);

namespace Carvago\VehicleCatalogueBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public const TREE_ROOT_NAME = 'carvago_vehicle_catalogue';
    public const ENDPOINT = 'endpoint';

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::TREE_ROOT_NAME);

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode(self::ENDPOINT)->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
