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

namespace Rami\SeoBundle\Sitemap;

use DOMException;

interface SitemapInterface
{
    public function generateSitemap(?string $baseUrl = null): void;

    /**
     * @param array<mixed> $attributes
     *
     * @throws DOMException
     */
    public function generateDynamicSitemap(array $attributes, ?string $baseUrl = null): void;
}
