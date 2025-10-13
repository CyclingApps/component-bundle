<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Twig\Components\LocaleSwitcher;

class LocaleSwitcher
{
    /**
     * @param array<string> $locales
     */
    public function __construct(
        public readonly array $locales,
        public readonly bool $showLocaleName = true,
    ) {
    }
}
