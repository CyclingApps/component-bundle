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
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class CyclingAppsComponentExtension extends Extension
{
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
}
