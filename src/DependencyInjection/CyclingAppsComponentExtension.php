<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class CyclingAppsComponentExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container): void
    {
        if (!$this->isTwigComponentAvailable($container)) {
            return;
        }

        $container->prependExtensionConfig('twig_component', [
            'defaults' => [
                'CyclingApps\ComponentBundle\Twig\Components\\' => 'cyclingapps',
            ],
        ]);
    }

    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('cycling_apps_component.locale_switcher.locales', $config['locale_switcher']['locales']);
        $container->setParameter('cycling_apps_component.locale_switcher.show_locale_name', $config['locale_switcher']['show_locale_name']);

        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.php');
    }

    public function getAlias(): string
    {
        return 'cycling_apps_component';
    }

    private function isTwigComponentAvailable(ContainerBuilder $container): bool
    {
        if (!interface_exists(PrependExtensionInterface::class)) {
            return false;
        }

        $bundles = $container->getParameter('kernel.bundles');

        return isset($bundles['TwigComponentBundle']);
    }
}
