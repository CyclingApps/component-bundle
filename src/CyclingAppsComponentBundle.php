<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle;

use CyclingApps\ComponentBundle\DependencyInjection\CyclingAppsComponentExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class CyclingAppsComponentBundle extends AbstractBundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new CyclingAppsComponentExtension();
    }
}
