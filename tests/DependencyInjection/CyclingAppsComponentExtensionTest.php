<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Tests\DependencyInjection;

use CyclingApps\ComponentBundle\DependencyInjection\CyclingAppsComponentExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CyclingAppsComponentExtensionTest extends TestCase
{
    public function testDefaultLocalesParameterIsRegistered(): void
    {
        $container = new ContainerBuilder();
        $extension = new CyclingAppsComponentExtension();

        $extension->load([], $container);

        $this->assertTrue($container->hasParameter('cycling_apps_component.locale_switcher.locales'));
        $this->assertEquals(['fr', 'en'], $container->getParameter('cycling_apps_component.locale_switcher.locales'));
        $this->assertTrue($container->hasParameter('cycling_apps_component.locale_switcher.show_locale_name'));
        $this->assertTrue($container->getParameter('cycling_apps_component.locale_switcher.show_locale_name'));
    }

    public function testCustomLocalesParameterIsRegistered(): void
    {
        $container = new ContainerBuilder();
        $extension = new CyclingAppsComponentExtension();

        $extension->load([
            [
                'locale_switcher' => [
                    'locales' => ['en', 'de', 'it'],
                ],
            ],
        ], $container);

        $this->assertTrue($container->hasParameter('cycling_apps_component.locale_switcher.locales'));
        $this->assertEquals(['en', 'de', 'it'], $container->getParameter('cycling_apps_component.locale_switcher.locales'));
        $this->assertTrue($container->getParameter('cycling_apps_component.locale_switcher.show_locale_name'));
    }

    public function testCustomShowLocaleNameParameterIsRegistered(): void
    {
        $container = new ContainerBuilder();
        $extension = new CyclingAppsComponentExtension();

        $extension->load([
            [
                'locale_switcher' => [
                    'show_locale_name' => false,
                ],
            ],
        ], $container);

        $this->assertTrue($container->hasParameter('cycling_apps_component.locale_switcher.show_locale_name'));
        $this->assertFalse($container->getParameter('cycling_apps_component.locale_switcher.show_locale_name'));
        $this->assertEquals(['fr', 'en'], $container->getParameter('cycling_apps_component.locale_switcher.locales'));
    }

    public function testExtensionAlias(): void
    {
        $extension = new CyclingAppsComponentExtension();

        $this->assertEquals('cycling_apps_component', $extension->getAlias());
    }
}
