<?php

declare(strict_types=1);

/*
 * Copyright (c) 2025.
 *
 * This file is part of the SEO Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\SeoBundle\Breadcrumb;

use Symfony\Component\Cache\ResettableInterface;

class BreadcrumbManager implements BreadcrumbManagerInterface, ResettableInterface
{
    /**
     * @param array<int, array{label: string, url: string|null}> $items
     * @param array<string, string>                              $options
     */
    public function __construct(
        public array $items = [],
        public array $options = [],
    ) {
        $this->options['list_class'] = 'breadcrumb';
        $this->options['list_item_class'] = 'breadcrumb-item';
        $this->options['active_item'] = 'active';
    }

    public function addItem(string $label, ?string $url = null): static
    {
        $this->items[] = [
            'label' => $label,
            'url' => $url,
        ];

        return $this;
    }

    public function reset(): void
    {
        $this->items = [];
    }

    /**
     * @return array<int, array{label: string, url: string|null}>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return array<string, string>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array<string, string> $options
     */
    public function setOptions(array $options): static
    {
        $this->options = $options;

        return $this;
    }
}
