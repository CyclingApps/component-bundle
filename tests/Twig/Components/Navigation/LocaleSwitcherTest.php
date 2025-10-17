<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Tests\Twig\Components\Navigation;

use CyclingApps\ComponentBundle\Twig\Components\Navigation\LocaleSwitcher;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

class LocaleSwitcherTest extends TestCase
{
    public function testComponentCanBeInstantiatedWithDefaultParameters(): void
    {
        $component = new LocaleSwitcher();
        $data = $component->preMount([]);

        $component->locales = $data['locales'];
        $component->showLocaleName = $data['showLocaleName'];

        $this->assertInstanceOf(LocaleSwitcher::class, $component);
        $this->assertEquals(['en', 'fr'], $component->locales);
        $this->assertTrue($component->showLocaleName);
    }

    public function testComponentCanBeInstantiatedWithCustomParameters(): void
    {
        $component = new LocaleSwitcher();
        $data = $component->preMount([
            'locales' => ['en', 'fr', 'nl'],
            'showLocaleName' => false,
        ]);

        $component->locales = $data['locales'];
        $component->showLocaleName = $data['showLocaleName'];

        $this->assertEquals(['en', 'fr', 'nl'], $component->locales);
        $this->assertFalse($component->showLocaleName);
    }

    public function testPreMountPreservesAdditionalData(): void
    {
        $component = new LocaleSwitcher();
        $result = $component->preMount(['custom' => 'value']);

        $this->assertArrayHasKey('custom', $result);
        $this->assertEquals('value', $result['custom']);
    }

    public function testComponentThrowsExceptionForInvalidLocalesType(): void
    {
        $this->expectException(InvalidOptionsException::class);

        $component = new LocaleSwitcher();
        $component->preMount(['locales' => 'en']);
    }

    public function testComponentThrowsExceptionForInvalidShowLocaleNameType(): void
    {
        $this->expectException(InvalidOptionsException::class);

        $component = new LocaleSwitcher();
        $component->preMount(['showLocaleName' => 'yes']);
    }
}
