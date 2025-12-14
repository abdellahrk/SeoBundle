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
     * @param string|null $viewport
     * @param string|null $author
     * @param string|null $contentType
     * @param bool $xuaCompatible
     * @param array|null $customMetaTags
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
        ?string $viewport = "",
        ?string $author = '',
        ?string $contentType = '',
        bool $xuaCompatible = false,
        ?array $customMetaTags = []
    ): string
    {
        $seo = $this->metaTags->getSeoMeta();
        $this->metaTags->setTitle($title ?: $seo->getTitle())
            ->setDescription($description ?: $seo->getDescription())
            ->setKeywords($keywords ?: $seo->getKeywords())
            ->setSubject($subject ?: $seo->getSubject())
            ->setCharacterEncoding($charset ?: $seo->getCharset())
            ->setRobots($robots ?: $seo->getRobots())
            ->setCanonical($canonical ?: $seo->getCanonical())
            ->setCopyright($copyright ?: $seo->getCopyright())
            ->setViewport($viewport ?: $seo->getViewport())
            ->setAuthor($author ?: $seo->getAuthor())
            ->setContentType($contentType ?: $seo->getContentType());

        if ($xuaCompatible) {
            $this->metaTags->setXUACompatible();
        }

        if (null !== $customMetaTags && [] !== $customMetaTags) {
            foreach ($customMetaTags as $name => $content) {
                $this->metaTags->setCustomMetaTag($name, $content);
            }
        }

        return $this->renderTags();
    }

    /**
     * @return string
     */
    private function renderTags(): string
    {
        $metaTags = '';

        $seoMeta = $this->metaTags->seoMeta;

        if (null !== $seoMeta->getTitle() && '' !== $seoMeta->getTitle()) {
            $metaTags .= sprintf('<title>%s</title>', $seoMeta->getTitle());
        }

        if (null !== $seoMeta->getDescription() && '' !== $seoMeta->getDescription()) {
            $metaTags .= sprintf('<meta name="description" content="%s" />', $seoMeta->getDescription());
        }

        if (null !== $seoMeta->getKeywords() && [] !== $seoMeta->getKeywords()) {
            $metaTags .= sprintf('<meta name="keywords" content="%s" />', implode(', ', $seoMeta->getKeywords()));
        }

        if (null !== $seoMeta->getCanonical() && '' !== $seoMeta->getCanonical()) {
            $metaTags .= sprintf('<link rel="canonical" href="%s" />', $seoMeta->getCanonical());
        }

        if (null !== $seoMeta->getAuthor() && '' !== $seoMeta->getAuthor()) {
            $metaTags .= sprintf('<meta name="author" content="%s" />', $seoMeta->getAuthor());
        }

        if (null !== $seoMeta->getCharset() && '' !== $seoMeta->getCharset()) {
            $metaTags .= sprintf('<meta charset="%s" />', $seoMeta->getCharset());
        }

        if (null !== $seoMeta->getRobots() && [] !== $seoMeta->getRobots()) {
            $metaTags .= sprintf('<meta name="robots" content="%s" />', implode(', ', $seoMeta->getRobots()));
        }

        if (null !== $seoMeta->getViewport() && '' !== $seoMeta->getViewport()) {
            $metaTags .= sprintf('<meta name="viewport" content="%s" />', $seoMeta->getViewport());
        }

        if (null !== $seoMeta->getContentSecurityPolicy() && '' !== $seoMeta->getContentSecurityPolicy()) {
            $metaTags .= sprintf('<meta name="Content-Security-Policy" content="%s" />', $seoMeta->getContentSecurityPolicy());
        }

        if (null !== $seoMeta->getContentType() && '' !== $seoMeta->getContentType()) {
            $metaTags .= sprintf('<meta name="Content-Type" content="%s" />', $seoMeta->getContentType());
        }

        // Render additional custom meta tags
        $tags = $this->metaTags->getMetaTags();
        foreach ($tags as $name => $value) {
            if (is_array($value)) {
                // Handle structured tags like default-style, x-ua-compatible, rel
                if (isset($value['http-equiv'], $value['value']) && '' !== $value['http-equiv'] && '' !== $value['value']) {
                    $metaTags .= sprintf('<meta http-equiv="%s" content="%s" />', $value['http-equiv'], $value['value']);
                } elseif (isset($value['rel'], $value['href']) && '' !== $value['rel'] && '' !== $value['href']) {
                    if (isset($value['media']) && '' !== $value['media']) {
                        $metaTags .= sprintf('<link rel="%s" href="%s" media="%s" />', $value['rel'], $value['href'], $value['media']);
                    } else {
                        $metaTags .= sprintf('<link rel="%s" href="%s" />', $value['rel'], $value['href']);
                    }
                }
            } elseif ('charset' !== $name) {
                // Handle custom meta tags (skip charset as it's already handled above)
                $metaTags .= sprintf('<meta name="%s" content="%s" />', $name, $value);
            }
        }

        return $metaTags;
    }
}