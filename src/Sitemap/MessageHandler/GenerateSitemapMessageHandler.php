<?php
/*
 * Copyright (c) 2025.
 *
 * This file is part of the SEO Bundle project
 * @author Abdellah Ramadan
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\SeoBundle\Sitemap\MessageHandler;

use Rami\SeoBundle\Sitemap\Message\GenerateSitemapMessage;
use Rami\SeoBundle\Sitemap\SitemapInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
final class GenerateSitemapMessageHandler
{
    public function __construct(
        private SitemapInterface $sitemap,
    )
    {
    }

    public function __invoke(GenerateSitemapMessage $message): void
    {
        $this->sitemap->generateSitemap();
    }
}