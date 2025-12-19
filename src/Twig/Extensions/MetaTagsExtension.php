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

namespace Rami\SeoBundle\Twig\Extensions;

use Rami\SeoBundle\Metas\MetaTagsManagerInterface;
use Twig\Attribute\AsTwigFunction;

use function is_array;
use function is_string;
use function sprintf;

class MetaTagsExtension
{
    public function __construct(
        private readonly MetaTagsManagerInterface $metaTagsManager
    ) {
    }

    #[AsTwigFunction('lang_head_value', isSafe: ['html'])]
    public function renderHeadLang(string $lang): string
    {
        return 'lang="'.$lang.'"';
    }

    /**
     * @param array<int, string>|null   $keywords
     * @param array<int, string>|null   $robots
     * @param array<string, mixed>|null $customMetaTags
     */
    #[AsTwigFunction('meta_tags', isSafe: ['html'])]
    public function renderMetaTags(
        ?string $title = '',
        ?string $description = '',
        ?array $keywords = [],
        ?string $subject = '',
        ?string $charset = 'utf-8',
        ?array $robots = [],
        ?string $canonical = '',
        ?string $copyright = '',
        ?string $viewport = '',
        ?string $author = '',
        ?string $contentType = '',
        bool $xuaCompatible = false,
        ?array $customMetaTags = []
    ): string {
        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->metaTagsManager->setTitle($title ?: $seoMeta->getTitle())
            ->setDescription($description ?: $seoMeta->getDescription())
            ->setKeywords($keywords ?: $seoMeta->getKeywords())
            ->setSubject($subject ?: $seoMeta->getSubject())
            ->setCharacterEncoding($charset ?: $seoMeta->getCharset())
            ->setRobots($robots ?: $seoMeta->getRobots())
            ->setCanonical($canonical ?: $seoMeta->getCanonical())
            ->setCopyright($copyright ?: $seoMeta->getCopyright())
            ->setViewport($viewport ?: $seoMeta->getViewport())
            ->setAuthor($author ?: $seoMeta->getAuthor())
            ->setContentType($contentType ?: $seoMeta->getContentType());

        if ($xuaCompatible) {
            $this->metaTagsManager->setXUACompatible();
        }

        if (null !== $customMetaTags && [] !== $customMetaTags) {
            foreach ($customMetaTags as $name => $content) {
                if (is_string($content)) {
                    $this->metaTagsManager->setCustomMetaTag($name, $content);
                }
            }
        }

        return $this->renderTags();
    }

    private function renderTags(): string
    {
        $metaTags = '';

        $seoMeta = $this->metaTagsManager->getSeoMeta();

        $charset = $seoMeta->getCharset();
        if ('' !== $charset) {
            $metaTags .= sprintf('<meta charset="%s" />', $charset);
        }

        $title = $seoMeta->getTitle();
        if ('' !== $title) {
            $metaTags .= sprintf('<title>%s</title>', $title);
        }

        $description = $seoMeta->getDescription();
        if ('' !== $description) {
            $metaTags .= sprintf('<meta name="description" content="%s" />', $description);
        }

        $keywords = $seoMeta->getKeywords();
        if ([] !== $keywords) {
            $metaTags .= sprintf('<meta name="keywords" content="%s" />', implode(', ', $keywords));
        }

        $canonical = $seoMeta->getCanonical();
        if ('' !== $canonical) {
            $metaTags .= sprintf('<link rel="canonical" href="%s" />', $canonical);
        }

        $author = $seoMeta->getAuthor();
        if ('' !== $author) {
            $metaTags .= sprintf('<meta name="author" content="%s" />', $author);
        }

        $robots = $seoMeta->getRobots();
        if ([] !== $robots) {
            $metaTags .= sprintf('<meta name="robots" content="%s" />', implode(', ', $robots));
        }

        $viewport = $seoMeta->getViewport();
        if ('' !== $viewport) {
            $metaTags .= sprintf('<meta name="viewport" content="%s" />', $viewport);
        }

        $contentSecurityPolicy = $seoMeta->getContentSecurityPolicy();
        if ('' !== $contentSecurityPolicy) {
            $metaTags .= sprintf('<meta name="Content-Security-Policy" content="%s" />', $contentSecurityPolicy);
        }

        $contentType = $seoMeta->getContentType();
        if ('' !== $contentType) {
            $metaTags .= sprintf('<meta name="Content-Type" content="%s" />', $contentType);
        }

        // Render additional custom meta tags
        $tags = $this->metaTagsManager->getMetaTags();
        foreach ($tags as $name => $value) {
            if (is_array($value)) {
                // Handle structured tags like default-style, x-ua-compatible, rel
                if (isset($value['http-equiv'], $value['value']) && is_string($value['http-equiv']) && is_string($value['value']) && '' !== $value['http-equiv'] && '' !== $value['value']) {
                    $metaTags .= sprintf('<meta http-equiv="%s" content="%s" />', $value['http-equiv'], $value['value']);
                } elseif (isset($value['rel'], $value['href']) && is_string($value['rel']) && is_string($value['href']) && '' !== $value['rel'] && '' !== $value['href']) {
                    if (isset($value['media']) && is_string($value['media']) && '' !== $value['media']) {
                        $metaTags .= sprintf('<link rel="%s" href="%s" media="%s" />', $value['rel'], $value['href'], $value['media']);
                    } else {
                        $metaTags .= sprintf('<link rel="%s" href="%s" />', $value['rel'], $value['href']);
                    }
                }
            } elseif ('charset' !== $name && is_string($value)) {
                // Handle custom meta tags (skip charset as it's already handled above)
                $metaTags .= sprintf('<meta name="%s" content="%s" />', $name, $value);
            }
        }

        return $metaTags;
    }
}
