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

namespace Rami\SeoBundle\Sitemap\Message;

final class GenerateSitemapMessage
{
    public function __construct(
        private ?string $baseUrl = null,
    ) {}

    public function getBaseUrl(): ?string
    {
        return $this->baseUrl;
    }
}