<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Tests\DependencyInjection;

use CyclingApps\ComponentBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    public function testDefaultConfiguration(): void
    {
        $configuration = new Configuration();
        $processor = new Processor();

        $config = $processor->processConfiguration($configuration, []);

        $this->assertArrayHasKey('locale_switcher', $config);
        $this->assertArrayHasKey('locales', $config['locale_switcher']);
        $this->assertEquals(['fr', 'en'], $config['locale_switcher']['locales']);
        $this->assertArrayHasKey('show_locale_name', $config['locale_switcher']);
        $this->assertTrue($config['locale_switcher']['show_locale_name']);
    }

    public function testCustomLocalesConfiguration(): void
    {
        $configuration = new Configuration();
        $processor = new Processor();

        $config = $processor->processConfiguration($configuration, [
            'cycling_apps_component' => [
                'locale_switcher' => [
                    'locales' => ['en', 'de', 'es'],
                ],
            ],
        ]);

        $this->assertArrayHasKey('locale_switcher', $config);
        $this->assertEquals(['en', 'de', 'es'], $config['locale_switcher']['locales']);
        $this->assertTrue($config['locale_switcher']['show_locale_name']);
    }

    public function testEmptyLocalesConfiguration(): void
    {
        $configuration = new Configuration();
        $processor = new Processor();

        $config = $processor->processConfiguration($configuration, [
            'cycling_apps_component' => [
                'locale_switcher' => [
                    'locales' => [],
                ],
            ],
        ]);

        $this->assertArrayHasKey('locale_switcher', $config);
        $this->assertEquals([], $config['locale_switcher']['locales']);
        $this->assertTrue($config['locale_switcher']['show_locale_name']);
    }

    public function testCustomShowLocaleNameConfiguration(): void
    {
        $configuration = new Configuration();
        $processor = new Processor();

        $config = $processor->processConfiguration($configuration, [
            'cycling_apps_component' => [
                'locale_switcher' => [
                    'show_locale_name' => false,
                ],
            ],
        ]);

        $this->assertArrayHasKey('locale_switcher', $config);
        $this->assertEquals(['fr', 'en'], $config['locale_switcher']['locales']);
        $this->assertFalse($config['locale_switcher']['show_locale_name']);
    }
}
