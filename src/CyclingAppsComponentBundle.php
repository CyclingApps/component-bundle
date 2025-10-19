<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle;

use CyclingApps\ComponentBundle\DependencyInjection\CyclingAppsComponentExtension;
use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class CyclingAppsComponentBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        if (!interface_exists(AssetMapperInterface::class)) {
            return;
        }

        $metadata = $builder->getParameter('kernel.bundles_metadata');

        if (!\is_array($metadata) || !isset($metadata['FrameworkBundle'])) {
            return;
        }

        if (!is_file($metadata['FrameworkBundle']['path'].'/Resources/config/asset_mapper.php')) {
            return;
        }

        $builder->prependExtensionConfig('framework', [
            'asset_mapper' => [
                'paths' => [
                    __DIR__.'/../assets/dist',
                ],
            ],
        ]);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new CyclingAppsComponentExtension();
    }
}
