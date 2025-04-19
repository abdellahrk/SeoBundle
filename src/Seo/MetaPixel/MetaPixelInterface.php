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

namespace Rami\SeoBundle\Seo\MetaPixel;

interface MetaPixelInterface
{
    public function enableMetaPixel(?string $pixelId): void;

    public function renderPixel(): string;
}