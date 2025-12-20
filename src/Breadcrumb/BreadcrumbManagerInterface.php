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

interface BreadcrumbManagerInterface
{
    public function addItem(string $label, ?string $url = null): static;

    /**
     * @return array<int, array{label: string, url: string|null}>
     */
    public function getItems(): array;

    /**
     * @return array<string, string>
     */
    public function getOptions(): array;

    /**
     * @param array<string, string> $options
     */
    public function setOptions(array $options): static;
}
