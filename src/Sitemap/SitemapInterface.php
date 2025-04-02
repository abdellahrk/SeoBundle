<?php

namespace Rami\SeoBundle\Sitemap;

interface SitemapInterface
{
    public function generateSitemap(): void;
}