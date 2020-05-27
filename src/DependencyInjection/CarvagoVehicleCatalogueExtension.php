<?php

declare(strict_types=1);

namespace Carvago\VehicleCatalogueBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

use function array_key_exists;

final class CarvagoVehicleCatalogueExtension extends Extension
{
    /**
     * @param array<string, mixed> $configs
     * @param ContainerBuilder $container
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('carvago_vehicle_catalogue_client');

        if (!array_key_exists(Configuration::ENDPOINT, $config)) {
            return;
        }

        $definition->replaceArgument(0, $config[Configuration::ENDPOINT]);
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return Configuration::TREE_ROOT_NAME;
    }
}
