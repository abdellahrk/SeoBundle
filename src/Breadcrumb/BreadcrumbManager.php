<?php
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

    /**
     * @inheritDoc
     */
    public function reset(): void
    {
        $this->items = [];
    }

    public function getItems(): array
    {
       return $this->items;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): static
    {
        $this->options = $options;
        return $this;
    }
}