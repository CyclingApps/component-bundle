<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Tests\Twig\Components\Modal;

use CyclingApps\ComponentBundle\Twig\Components\Modal\Modal;
use PHPUnit\Framework\TestCase;

class ModalTest extends TestCase
{
    public function testModalCanBeInstantiated(): void
    {
        $modal = new Modal();
        $this->assertInstanceOf(Modal::class, $modal);
    }
}
