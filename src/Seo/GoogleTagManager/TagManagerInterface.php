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

namespace Rami\SeoBundle\Seo\GoogleTagManager;

interface TagManagerInterface
{
    public function enableGoogleTagManager(?string $gtmId): void;

    public function renderHeadTag(): string;

    public function renderBodyTag(): string;
}
