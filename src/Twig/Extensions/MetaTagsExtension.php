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

namespace Rami\SeoBundle\Twig\Extensions;

use Rami\SeoBundle\Metas\MetaTagsManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MetaTagsExtension extends AbstractExtension
{
    public function __construct(
        private MetaTagsManagerInterface $metaTags
    ){}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('meta_tags', [$this, 'renderMetaTags'], ['is_safe' => ['html']]),
            new TwigFunction('lang_head_value', [$this, 'renderHeadLang'], ['is_safe' => ['html']]),
        ];
    }

    public function renderHeadLang(string $lang): string
    {
        return 'lang="'.$lang.'"';
    }

    public function renderMetaTags(): string
    {
        $metaTags = '';
        $seoMeta = $this->metaTags->seoMeta;

        if (null !== $seoMeta->getTitle()) {
            $metaTags .= sprintf('<title>%s</title>', $seoMeta->getTitle());
        }

        if (null !== $seoMeta->getDescription()) {
            $metaTags .= sprintf('<meta name="description" content="%s" />', $seoMeta->getDescription());
        }

        if (null !== $seoMeta->getKeywords()) {
            $metaTags .= sprintf('<meta name="keywords" content="%s" />', implode(', ', $seoMeta->getKeywords()));
        }

        if (!empty($seoMeta->getCanonical())) {
            $metaTags .= sprintf('<link rel="canonical" href="%s" />', $seoMeta->getCanonical());
        }

        if (null !== $seoMeta->getAuthor()) {
            $metaTags .= sprintf('<meta name="author" content="%s" />', $seoMeta->getAuthor());
        }

        if (null !== $seoMeta->getCharset()) {
            $metaTags .= sprintf('<meta charset="%s" />', $seoMeta->getCharset());
        }

        if (!empty($seoMeta->getRobots())) {
            $metaTags .= sprintf('<meta name="robots" content="%s" />', implode(', ', $seoMeta->getRobots()));
        }

        if (null !== $seoMeta->getViewport()) {
            $metaTags .= sprintf('<meta name="viewport" content="%s" />', $seoMeta->getViewport());
        }

        if (null !== $seoMeta->getContentSecurityPolicy()) {
            $metaTags .= sprintf('<meta name="Content-Security-Policy" content="%s" />', $seoMeta->getContentSecurityPolicy());
        }

        if (null !== $seoMeta->getContentType()) {
            $metaTags .= sprintf('<meta name="Content-Type" content="%s" />', $seoMeta->getContentType());
        }

       return $metaTags;
    }
}