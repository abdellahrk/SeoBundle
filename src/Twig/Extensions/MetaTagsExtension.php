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

    /**
     * @param string $lang
     * @return string
     */
    public function renderHeadLang(string $lang): string
    {
        return 'lang="'.$lang.'"';
    }


    /**
     * @param string|null $title
     * @param string|null $description
     * @param array|null $keywords
     * @param string|null $subject
     * @param string|null $charset
     * @param array|null $robots
     * @param string|null $canonical
     * @param string|null $copyright
     * @param array|null $viewport
     * @param string|null $author
     * @param string|null $contentType
     * @return string
     */
    public function renderMetaTags(
        ?string $title = '',
        ?string $description = '',
        ?array $keywords = [],
        ?string $subject = '',
        ?string $charset = 'utf-8',
        ?array $robots = [],
        ?string $canonical = '',
        ?string $copyright = '',
        ?array $viewport = [],
        ?string $author = '',
        ?string $contentType = ''
    ): string
    {
        $seo = $this->metaTags->seoMeta;
        $this->metaTags->setTitle( $title ?: $seo->getTitle())
            ->setDescription($description ?: $seo->getDescription())
            ->setKeywords($keywords ?: $seo->getKeywords())
            ->setSubject($subject ?: $seo->getSubject())
            ->setCharacterEncoding($charset ?: $seo->getCharset())
            ->setRobots($robots ?: $seo->getRobots())
            ->setCanonical($canonical ?: $seo->getCanonical())
            ->setCopyright($copyright ?: $seo->getCopyright())
            ->setViewport(...$viewport ?: $seo->getViewport())
            ->setAuthor($author ?: $seo->getAuthor())
            ->setContentType($contentType ?: $seo->getContentType())
        ;

        return $this->renderTags();
    }

    /**
     * @return string
     */
    private function renderTags(): string
    {
        $metaTags = '';

        $seoMeta = $this->metaTags->seoMeta;

        if (!empty($seoMeta->getTitle())) {
            $metaTags .= sprintf('<title>%s</title>', $seoMeta->getTitle());
        }

        if (!empty($seoMeta->getDescription())) {
            $metaTags .= sprintf('<meta name="description" content="%s" />', $seoMeta->getDescription());
        }

        if (!empty($seoMeta->getKeywords())) {
            $metaTags .= sprintf('<meta name="keywords" content="%s" />', implode(', ', $seoMeta->getKeywords()));
        }

        if (!empty($seoMeta->getCanonical())) {
            $metaTags .= sprintf('<link rel="canonical" href="%s" />', $seoMeta->getCanonical());
        }

        if (!empty($seoMeta->getAuthor())) {
            $metaTags .= sprintf('<meta name="author" content="%s" />', $seoMeta->getAuthor());
        }

        if (!empty($seoMeta->getCharset())) {
            $metaTags .= sprintf('<meta charset="%s" />', $seoMeta->getCharset());
        }

        if (!empty($seoMeta->getRobots())) {
            $metaTags .= sprintf('<meta name="robots" content="%s" />', implode(', ', $seoMeta->getRobots()));
        }

        if (!empty($seoMeta->getViewport())) {
            $metaTags .= sprintf('<meta name="viewport" content="%s" />', $seoMeta->getViewport());
        }

        if (!empty($seoMeta->getContentSecurityPolicy())) {
            $metaTags .= sprintf('<meta name="Content-Security-Policy" content="%s" />', $seoMeta->getContentSecurityPolicy());
        }

        if (!empty($seoMeta->getContentType())) {
            $metaTags .= sprintf('<meta name="Content-Type" content="%s" />', $seoMeta->getContentType());
        }

        return $metaTags;
    }
}