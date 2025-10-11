<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Tests\Twig\Components\LocaleSwitcher;

use CyclingApps\ComponentBundle\Twig\Components\LocaleSwitcher\LocaleSwitcher;
use PHPUnit\Framework\TestCase;

class LocaleSwitcherTest extends TestCase
{
    public function testComponentCanBeInstantiatedWithDefaultParameters(): void
    {
        $locales = ['fr', 'en'];
        $component = new LocaleSwitcher($locales);

        $this->assertInstanceOf(LocaleSwitcher::class, $component);
        $this->assertEquals(['fr', 'en'], $component->locales);
        $this->assertTrue($component->showLocaleName);
    }

    public function testComponentCanBeInstantiatedWithCustomLocales(): void
    {
        $locales = ['en', 'de', 'es', 'it'];
        $component = new LocaleSwitcher($locales);

        $this->assertInstanceOf(LocaleSwitcher::class, $component);
        $this->assertEquals(['en', 'de', 'es', 'it'], $component->locales);
        $this->assertTrue($component->showLocaleName);
    }

    public function testComponentCanBeInstantiatedWithShowLocaleNameSetToFalse(): void
    {
        $locales = ['fr', 'en'];
        $component = new LocaleSwitcher($locales, false);

        $this->assertInstanceOf(LocaleSwitcher::class, $component);
        $this->assertEquals(['fr', 'en'], $component->locales);
        $this->assertFalse($component->showLocaleName);
    }

    public function testComponentCanBeInstantiatedWithShowLocaleNameSetToTrue(): void
    {
        $locales = ['fr', 'en', 'de'];
        $component = new LocaleSwitcher($locales, true);

        $this->assertInstanceOf(LocaleSwitcher::class, $component);
        $this->assertEquals(['fr', 'en', 'de'], $component->locales);
        $this->assertTrue($component->showLocaleName);
    }

    public function testComponentCanBeInstantiatedWithEmptyLocalesArray(): void
    {
        $locales = [];
        $component = new LocaleSwitcher($locales);

        $this->assertInstanceOf(LocaleSwitcher::class, $component);
        $this->assertEquals([], $component->locales);
        $this->assertTrue($component->showLocaleName);
    }

    public function testComponentCanBeInstantiatedWithSingleLocale(): void
    {
        $locales = ['en'];
        $component = new LocaleSwitcher($locales, false);

        $this->assertInstanceOf(LocaleSwitcher::class, $component);
        $this->assertEquals(['en'], $component->locales);
        $this->assertFalse($component->showLocaleName);
    }

    public function testComponentPropertiesAreReadonly(): void
    {
        $locales = ['fr', 'en'];
        $component = new LocaleSwitcher($locales);

        $reflection = new \ReflectionClass($component);
        $localesProperty = $reflection->getProperty('locales');
        $showLocaleNameProperty = $reflection->getProperty('showLocaleName');

        $this->assertTrue($localesProperty->isReadOnly());
        $this->assertTrue($showLocaleNameProperty->isReadOnly());
    }
}
