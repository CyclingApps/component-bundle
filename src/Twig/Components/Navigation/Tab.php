<?php

/*
 * This file is part of the CyclingApps package.
 * Copyright (c) CyclingApps <https://github.com/CyclingApps>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CyclingApps\ComponentBundle\Twig\Components\Navigation;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\PreMount;

class Tab
{
    /**
     * @var array<string, string>
     */
    public array $tabs;
    public ?string $activeTab;
    public ?string $activeContent;
    public string $variant;
    public bool $fill;
    public bool $justified;
    public string $alignment;

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
            'tabs' => [],
            'activeTab' => null,
            'activeContent' => null,
            'variant' => 'tabs',
            'fill' => false,
            'justified' => false,
            'alignment' => 'start',
        ]);

        $resolver->setAllowedTypes('tabs', 'array');
        $resolver->setAllowedTypes('activeTab', ['string', 'null']);
        $resolver->setAllowedTypes('activeContent', ['string', 'null']);
        $resolver->setAllowedTypes('variant', 'string');
        $resolver->setAllowedTypes('fill', 'bool');
        $resolver->setAllowedTypes('justified', 'bool');
        $resolver->setAllowedTypes('alignment', 'string');

        $resolver->setAllowedValues('variant', ['tabs', 'pills']);
        $resolver->setAllowedValues('alignment', ['start', 'center', 'end']);
    }
}
