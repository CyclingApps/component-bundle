<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Tests\Twig\Components\Navigation;

use CyclingApps\ComponentBundle\Twig\Components\Navigation\Menu;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

class MenuTest extends TestCase
{
    public function testComponentCanBeInstantiatedWithDefaultParameters(): void
    {
        $component = new Menu();
        $data = $component->preMount([]);

        $component->align = $data['align'];

        $this->assertInstanceOf(Menu::class, $component);
        $this->assertEquals('start', $component->align);
    }

    public function testComponentCanBeInstantiatedWithCustomParameters(): void
    {
        $component = new Menu();
        $data = $component->preMount([
            'align' => 'center',
        ]);

        $component->align = $data['align'];

        $this->assertEquals('center', $component->align);
    }

    public function testComponentSupportsAllAlignValues(): void
    {
        $alignValues = ['start', 'center', 'end'];

        foreach ($alignValues as $align) {
            $component = new Menu();
            $data = $component->preMount(['align' => $align]);

            $component->align = $data['align'];

            $this->assertEquals($align, $component->align);
        }
    }

    public function testComponentThrowsExceptionForInvalidAlign(): void
    {
        $this->expectException(InvalidOptionsException::class);

        $component = new Menu();
        $component->preMount(['align' => 'invalid']);
    }

    public function testPreMountReturnsArrayWithResolvedData(): void
    {
        $component = new Menu();
        $result = $component->preMount(['align' => 'end']);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('align', $result);
        $this->assertEquals('end', $result['align']);
    }

    public function testPreMountPreservesAdditionalData(): void
    {
        $component = new Menu();
        $result = $component->preMount(['align' => 'start', 'custom_attribute' => 'value']);

        $this->assertArrayHasKey('custom_attribute', $result);
        $this->assertEquals('value', $result['custom_attribute']);
    }
}
