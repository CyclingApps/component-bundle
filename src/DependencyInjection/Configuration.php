<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('cycling_apps_component');

        // @phpstan-ignore-next-line
        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('locale_switcher')
                    ->info('Configuration for the LocaleSwitcher component')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('locales')
                            ->info('Available locales for the application')
                            ->defaultValue(['fr', 'en'])
                            ->scalarPrototype()->end()
                        ->end()
                        ->booleanNode('show_locale_name')
                            ->info('Whether to show the locale name in the switcher')
                            ->defaultTrue()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
