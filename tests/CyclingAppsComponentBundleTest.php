<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle«\Tests;

use CyclingApps\ComponentBundle\CyclingAppsComponentBundle;
use CyclingApps\ComponentBundle\DependencyInjection\CyclingAppsComponentExtension;
use PHPUnit\Framework\TestCase;

class CyclingAppsComponentBundleTest extends TestCase
{
    public function testBundleCanBeInstantiated(): void
    {
        $bundle = new CyclingAppsComponentBundle();
        $this->assertInstanceOf(CyclingAppsComponentBundle::class, $bundle);
    }

    public function testGetPath(): void
    {
        $bundle = new CyclingAppsComponentBundle();
        $path = $bundle->getPath();

        $this->assertIsString($path);
        $this->assertDirectoryExists($path);
        $this->assertDirectoryExists($path.'/src');
    }

    public function testBundleNameIsCorrect(): void
    {
        $bundle = new CyclingAppsComponentBundle();

        // Test that the bundle can be used in a container
        $reflection = new \ReflectionClass($bundle);
        $this->assertEquals('CyclingAppsComponentBundle', $reflection->getShortName());
        $this->assertEquals('CyclingApps\ComponentBundle', $reflection->getNamespaceName());
    }

    public function testGetContainerExtension(): void
    {
        $bundle = new CyclingAppsComponentBundle();
        $extension = $bundle->getContainerExtension();

        $this->assertInstanceOf(CyclingAppsComponentExtension::class, $extension);
        $this->assertEquals('cycling_apps_component', $extension->getAlias());
    }
}
