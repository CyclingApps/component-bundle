<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use CyclingApps\ComponentBundle\Twig\Components\LocaleSwitcher\LocaleSwitcher;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set(LocaleSwitcher::class)
        ->arg('$locales', param('cycling_apps_component.locale_switcher.locales'))
        ->arg('$showLocaleName', param('cycling_apps_component.locale_switcher.show_locale_name'));
};
