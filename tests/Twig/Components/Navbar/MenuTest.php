<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Tests\Twig\Components\Navbar;

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
        $component->direction = $data['direction'];

        $this->assertInstanceOf(Menu::class, $component);
        $this->assertEquals('start', $component->align);
        $this->assertEquals('horizontal', $component->direction);
    }

    public function testComponentCanBeInstantiatedWithCustomParameters(): void
    {
        $component = new Menu();
        $data = $component->preMount([
            'align' => 'center',
            'direction' => 'vertical',
        ]);

        $component->align = $data['align'];
        $component->direction = $data['direction'];

        $this->assertEquals('center', $component->align);
        $this->assertEquals('vertical', $component->direction);
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

    public function testComponentSupportsAllDirectionValues(): void
    {
        $directionValues = ['horizontal', 'vertical'];

        foreach ($directionValues as $direction) {
            $component = new Menu();
            $data = $component->preMount(['direction' => $direction]);

            $component->direction = $data['direction'];

            $this->assertEquals($direction, $component->direction);
        }
    }

    public function testComponentThrowsExceptionForInvalidAlign(): void
    {
        $this->expectException(InvalidOptionsException::class);

        $component = new Menu();
        $component->preMount(['align' => 'invalid']);
    }

    public function testComponentThrowsExceptionForInvalidDirection(): void
    {
        $this->expectException(InvalidOptionsException::class);

        $component = new Menu();
        $component->preMount(['direction' => 'invalid']);
    }

    public function testPreMountReturnsArrayWithResolvedData(): void
    {
        $component = new Menu();
        $result = $component->preMount(['align' => 'end']);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('align', $result);
        $this->assertArrayHasKey('direction', $result);
        $this->assertEquals('end', $result['align']);
        $this->assertEquals('horizontal', $result['direction']);
    }

    public function testPreMountPreservesAdditionalData(): void
    {
        $component = new Menu();
        $result = $component->preMount(['align' => 'start', 'custom_attribute' => 'value']);

        $this->assertArrayHasKey('custom_attribute', $result);
        $this->assertEquals('value', $result['custom_attribute']);
    }
}
