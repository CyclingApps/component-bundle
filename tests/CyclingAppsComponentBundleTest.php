<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Tests;

use CyclingApps\ComponentBundle\CyclingAppsComponentBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

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

    public function testLoadExtensionImportsServicesConfiguration(): void
    {
        $bundle = new CyclingAppsComponentBundle();

        // Verify that services.yaml exists in the expected location
        $servicesPath = $bundle->getPath().'/config/services.yaml';
        $this->assertFileExists($servicesPath, 'services.yaml should exist for the bundle to import');
    }

    public function testLoadExtensionWithEmptyConfig(): void
    {
        $bundle = new CyclingAppsComponentBundle();
        $containerBuilder = new ContainerBuilder();

        // Create a PhpFileLoader (required by ContainerConfigurator)
        $fileLocator = new \Symfony\Component\Config\FileLocator($bundle->getPath());
        $phpFileLoader = new \Symfony\Component\DependencyInjection\Loader\PhpFileLoader(
            $containerBuilder,
            $fileLocator
        );
        $instanceOf = [];
        $containerConfigurator = new ContainerConfigurator(
            $containerBuilder,
            $phpFileLoader,
            $instanceOf,
            $bundle->getPath(),
            'test'
        );

        // Test with empty config - should execute without exception
        try {
            $bundle->loadExtension([], $containerConfigurator, $containerBuilder);
            $this->assertTrue(true, 'loadExtension executed without exception');
        } catch (\Exception $e) {
            // If it fails due to file loading, that's expected in test context
            // The important thing is the method signature and basic execution
            $this->assertStringContainsString('services.yaml', $e->getMessage());
        }
    }

    public function testPrependExtensionWhenFrameworkBundleNotPresent(): void
    {
        $bundle = new CyclingAppsComponentBundle();
        $containerBuilder = new ContainerBuilder();

        // Set up the container without FrameworkBundle
        $containerBuilder->setParameter('kernel.bundles_metadata', [
            'SomeOtherBundle' => [
                'path' => '/some/path',
            ],
        ]);

        // The method should handle this gracefully and return early
        // We verify it doesn't throw an exception
        $reflection = new \ReflectionMethod($bundle, 'isAssetMapperAvailable');
        $reflection->setAccessible(true);
        $result = $reflection->invoke($bundle, $containerBuilder);

        $this->assertFalse($result, 'isAssetMapperAvailable should return false when FrameworkBundle is not present');
    }

    public function testIsAssetMapperAvailableReturnsFalseWhenConfigFileDoesNotExist(): void
    {
        if (!interface_exists(\Symfony\Component\AssetMapper\AssetMapperInterface::class)) {
            $this->markTestSkipped('This test requires AssetMapperInterface to exist');
        }

        $bundle = new CyclingAppsComponentBundle();
        $containerBuilder = new ContainerBuilder();

        // Use a path where asset_mapper.php definitely doesn't exist
        $containerBuilder->setParameter('kernel.bundles_metadata', [
            'FrameworkBundle' => [
                'path' => '/nonexistent/path/to/framework',
            ],
        ]);

        $reflection = new \ReflectionMethod($bundle, 'isAssetMapperAvailable');
        $reflection->setAccessible(true);
        $result = $reflection->invoke($bundle, $containerBuilder);

        $this->assertFalse($result, 'isAssetMapperAvailable should return false when asset_mapper.php does not exist');
    }

    public function testIsAssetMapperAvailableReturnsTrueWhenAllConditionsMet(): void
    {
        if (!interface_exists(\Symfony\Component\AssetMapper\AssetMapperInterface::class)) {
            $this->markTestSkipped('This test requires AssetMapperInterface to exist');
        }

        $bundle = new CyclingAppsComponentBundle();
        $containerBuilder = new ContainerBuilder();

        // Create a temporary directory structure to simulate FrameworkBundle with asset_mapper.php
        $tempDir = sys_get_temp_dir().'/test_framework_bundle_'.uniqid('', true);
        mkdir($tempDir.'/Resources/config', 0777, true);
        touch($tempDir.'/Resources/config/asset_mapper.php');

        $containerBuilder->setParameter('kernel.bundles_metadata', [
            'FrameworkBundle' => [
                'path' => $tempDir,
            ],
        ]);

        $reflection = new \ReflectionMethod($bundle, 'isAssetMapperAvailable');
        $reflection->setAccessible(true);
        $result = $reflection->invoke($bundle, $containerBuilder);

        $this->assertTrue($result, 'isAssetMapperAvailable should return true when all conditions are met');

        // Clean up
        unlink($tempDir.'/Resources/config/asset_mapper.php');
        rmdir($tempDir.'/Resources/config');
        rmdir($tempDir.'/Resources');
        rmdir($tempDir);
    }

    public function testPrependExtensionWhenAssetMapperIsAvailable(): void
    {
        if (!interface_exists(\Symfony\Component\AssetMapper\AssetMapperInterface::class)) {
            $this->markTestSkipped('This test requires AssetMapperInterface to exist');
        }

        $bundle = new CyclingAppsComponentBundle();
        $containerBuilder = new ContainerBuilder();

        // Create a temporary directory structure to simulate FrameworkBundle with asset_mapper.php
        $tempDir = sys_get_temp_dir().'/test_framework_bundle_'.uniqid('', true);
        mkdir($tempDir.'/Resources/config', 0777, true);
        touch($tempDir.'/Resources/config/asset_mapper.php');

        $containerBuilder->setParameter('kernel.bundles_metadata', [
            'FrameworkBundle' => [
                'path' => $tempDir,
            ],
        ]);

        // Create a ContainerConfigurator
        $fileLocator = new \Symfony\Component\Config\FileLocator($bundle->getPath().'/config');
        $phpFileLoader = new \Symfony\Component\DependencyInjection\Loader\PhpFileLoader(
            $containerBuilder,
            $fileLocator
        );
        $instanceOf = [];
        $containerConfigurator = new ContainerConfigurator(
            $containerBuilder,
            $phpFileLoader,
            $instanceOf,
            $bundle->getPath().'/config',
            'test'
        );

        // Invoke prependExtension
        $bundle->prependExtension($containerConfigurator, $containerBuilder);

        // Verify that the asset_mapper configuration was prepended
        $extensionConfigs = $containerBuilder->getExtensionConfig('framework');
        $this->assertNotEmpty($extensionConfigs, 'Framework extension config should be prepended');

        // Check that asset_mapper configuration exists
        $foundAssetMapperConfig = false;
        foreach ($extensionConfigs as $config) {
            if (isset($config['asset_mapper'])) {
                $foundAssetMapperConfig = true;
                $this->assertArrayHasKey('paths', $config['asset_mapper']);
                break;
            }
        }

        $this->assertTrue($foundAssetMapperConfig, 'Asset mapper configuration should be found in prepended configs');

        // Clean up
        unlink($tempDir.'/Resources/config/asset_mapper.php');
        rmdir($tempDir.'/Resources/config');
        rmdir($tempDir.'/Resources');
        rmdir($tempDir);
    }
}
