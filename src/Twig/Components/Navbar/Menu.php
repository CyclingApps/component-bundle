<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Twig\Components\Navbar;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent('cyclingapps_menu', template: '@CyclingAppsComponent/components/navbar/menu.html.twig')]
class Menu
{
    public string $align;
    public string $direction;

    /**
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        return $resolver->resolve($data) + $data;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setIgnoreUndefined();
        $resolver->setDefaults([
            'align' => 'start',
            'direction' => 'horizontal',
        ]);

        $resolver->setAllowedTypes('align', 'string');
        $resolver->setAllowedTypes('direction', 'string');

        $resolver->setAllowedValues('align', ['start', 'center', 'end']);
        $resolver->setAllowedValues('direction', ['horizontal', 'vertical']);
    }
}
