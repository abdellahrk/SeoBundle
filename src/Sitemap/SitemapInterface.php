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

namespace Rami\SeoBundle\Sitemap;

interface SitemapInterface
{
    /**
     * @return void
     */
    public function generateSitemap(): void;

    /**
     * @param array<mixed> $attributes
     * @return void
     * @throws \DOMException
     */
    public function generateDynamicSitemap(array $attributes): void;
}