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

use Rami\SeoBundle\OpenGraph\OGArticleManagerInterface;
use Rami\SeoBundle\OpenGraph\OGImageManagerInterface;
use Rami\SeoBundle\OpenGraph\OGVideoManagerInterface;
use Rami\SeoBundle\OpenGraph\OpenGraphManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class OpenGraphExtension extends AbstractExtension
{
    
    public function __construct(
        private OpenGraphManagerInterface $openGraphManager,
        private OGImageManagerInterface $ogImageManager,
        private OGVideoManagerInterface $ogVideoManager,
        private OGArticleManagerInterface $ogArticleManager,
        private ParameterBagInterface $parameterBag
    ) {}
    public function getFunctions(): array
    {
        return [
            new TwigFunction('open_graph', [$this, 'renderOpenGraph'], ['is_safe' => ['html']]),
            new TwigFunction('og_image', [$this, 'renderOgImage'], ['is_safe' => ['html']]),
            new TwigFunction('og_video', [$this, 'renderOgVideo'], ['is_safe' => ['html']]),
            new TwigFunction('og_article', [$this, 'renderOgArticle'], ['is_safe' => ['html']]),
        ];
    }

    public function renderOpenGraph(
        ?string $title = '',
        ?string $description = '',
        ?string $siteName = '',
        ?string $url = '',
        ?string $imageUrl = '',
        ?string $imageAlt = '',
        ?string $type = '',
        ?string $locale = '',
        ?string $alternateLocale = '',
        ?string $audio = '',
        ?string $video = '',
    ): string
    {
        $og = $this->openGraphManager->getOpenGraph();
        $og->setTitle($title ?: $og->getTitle())
            ->setDescription($description ?: $og->getDescription())
            ->setSiteName($siteName ?: $og->getSiteName())
            ->setImageUrl($imageUrl ?: $og->getImageUrl())
            ->setImageAlt($imageAlt ?: $og->getImageAlt())
            ->setUrl($url ?: $og->getUrl())
            ->setType($type ?: $og->getType())
            ->setLocale($locale ?: $og->getLocale())
            ->setAlternateLocale($alternateLocale ?: $og->getAlternateLocale())
            ->setAudio($audio ?: $og->getAudio())
            ->setVideo($video ?: $og->getVideo());
        return $this->getOG();
    }

    public function renderOgImage(
        ?string $url = '',
        ?string $secureUrl = '',
        ?string $alt = '',
        ?string $type = '',
        ?string $width = '',
        ?string $height = '',
    ): string
    {
        $og = $this->ogImageManager->getImage();

        $og
            ->setUrl($url ?: $og->getUrl())
            ->setSecureUrl($secureUrl ?: $og->getSecureUrl())
            ->setAlt($alt ?: $og->getAlt())
            ->setType($type ?: $og->getType())
            ->setWidth($width ?: $og->getWidth())
            ->setHeight($height ?: $og->getHeight())
        ;

        return $this->getOgImage();
    }

    public function renderOgVideo(
        ?string $url = '',
        ?string $secureUrl = '',
        ?string $alt = '',
        ?string $type = '',
        ?string $width = '',
        ?string $height = '',
    ): string
    {
        $og = $this->ogVideoManager->getVideo();

        $og
            ->setUrl($url ?: $og->getUrl())
            ->setSecureUrl($secureUrl ?: $og->getSecureUrl())
            ->setType($type ?: $og->getType())
            ->setWidth($width ?: $og->getWidth())
            ->setHeight($height ?: $og->getHeight())
        ;

        return $this->getOgVideo();
    }

    public function renderOgArticle(
        ?\DateTime $publishedTime = null,
        ?\DateTime $modifiedTime = null,
        ?string $author = '',
        ?string $section = '',
        ?array $tags = []
    ): string
    {
        $og = $this->ogArticleManager->getArticle();

        $og
            ->setPublishedTime($publishedTime ?: $og->getPublishedTime())
            ->setModifiedTime($modifiedTime ?: $og->getModifiedTime())
            ->setAuthor($author ?: $og->getAuthor())
            ->setSection($section ?: $og->getSection())
            ->setTags($tags ?: $og->getTags())
        ;

        return $this->getOgArticle();
    }

    /**
     * @return string
     */
    private function getOG(): string
    {
        $openGraphString = '';
        $hasDefaultConfig = false;
        $openGraph = $this->openGraphManager->getOpenGraph();

        if ($this->parameterBag->has('seo.open_graph') && !empty($this->parameterBag->get('seo.open_graph'))) {
            $hasDefaultConfig = true;
        }

        if ($hasDefaultConfig) {
            $defaults = $this->parameterBag->get('seo.open_graph');
            if (empty($openGraph->getTitle())  && array_key_exists('title', $defaults)) {
                $openGraph->setTitle($defaults['title']);
            }

            if (empty($openGraph->getDescription()) && array_key_exists('description', $defaults)) {
                $openGraph->setDescription($defaults['description']);
            }

            if (empty($openGraph->getSiteName()) && array_key_exists('sitename', $defaults)) {
                $openGraph->setSiteName($defaults['sitename']);
            }

            if (empty($openGraph->getUrl()) && array_key_exists('url', $defaults)) {
                $openGraph->setUrl($defaults['url']);
            }

            if (empty($openGraph->getType()) && array_key_exists('type', $defaults)) {
                $openGraph->setType($defaults['type']);
            }
        }

        if (!empty($openGraph->getTitle())) {
            $openGraphString .=  sprintf('<meta property="og:title" content="%s" />', strip_tags($openGraph->getTitle()));
        }

        if ($openGraph->getDescription() !== '') {
            $openGraphString .= sprintf('<meta property="og:description" content="%s" />', strip_tags($openGraph->getDescription()));
        }

        if ($openGraph->getImageUrl() !== '') {
            $openGraphString .= sprintf('<meta property="og:image" content="%s" />', strip_tags($openGraph->getImageUrl()));
        }

        if ($openGraph->getUrl() !== '') {
            $openGraphString .= sprintf('<meta property="og:url" content="%s" />', strip_tags($openGraph->getUrl()));
        }

        if ($openGraph->getType() !== '') {
            $openGraphString .= sprintf('<meta property="og:type" content="%s" />',  strip_tags($openGraph->getType()));
        }

        if ($openGraph->getSiteName()) {
            $openGraphString .= sprintf('<meta property="og:site_name" content="%s" />', $openGraph->getSiteName());
        }

        if ($openGraph->getStructuredProperties()) {
            foreach ($openGraph->getStructuredProperties() as $property => $value) {
                $openGraphString .= sprintf('<meta property="og:%s" content="%s" />', $value[0]['type'], $value[0]['content']);
                foreach ($value as $index => $structuredProperty) {
                    $openGraphString .= sprintf('<meta property="og:%s:%s" content="%s" />', $structuredProperty['type'], $structuredProperty['property'], $structuredProperty['content']);
                }
            }
        }

        if ($openGraph->getMusicProperties()) {
            $contents = $openGraph->getMusicProperties();

            foreach ($contents as $content) {
                $openGraphString .= sprintf('<meta property="music:%s" content="%s" />', $content['property'], $content['content']);
            }
        }

        if ($openGraph->getTwitterCardProperties()) {
            foreach ($openGraph->getTwitterCardProperties() as $name => $content) {
                $openGraphString .= sprintf('<meta property=twitter:"%s" content="%s" />', $name, $content);
            }
        }

        return $openGraphString;
    }

    private function getOgImage(): string
    {
        $ogImage = $this->ogImageManager->getImage();

        $ogString = '';

        if (!empty($ogImage->getUrl())) {
            $ogString .= sprintf('<meta property="og:image" content="%s" />', $ogImage->getUrl());
        }
        
        if (!empty($ogImage->getSecureUrl())) {
            $ogString .= sprintf('<meta property="og:image:secure_url" content="%s">', $ogImage->getSecureUrl());
        }

        if (!empty($ogImage->getType())) {
            $ogString .= sprintf('<meta property="og:image:type" content="%s" />', $ogImage->getType());
        }

        if (!empty($ogImage->getWidth())) {
            $ogString .= sprintf('<meta property="og:image:width" content="%s" />', $ogImage->getWidth());
        }

        if (!empty($ogImage->getHeight())) {
            $ogString .= sprintf('<meta property="og:image:height" content="%s" />', $ogImage->getHeight());
        }

        if (!empty($ogImage->getAlt())) {
            $ogString .= sprintf('<meta property="og:image:alt" content="%s" />', $ogImage->getAlt());
        }

        return $ogString;
    }

    private function getOgVideo(): string
    {
        $ogVideo = $this->ogVideoManager->getVideo();

        $ogString = '';

        if (!empty($ogVideo->getUrl())) {
            $ogString .= sprintf('<meta property="og:video" content="%s" />', $ogVideo->getUrl());
        }

        if (!empty($ogVideo->getSecureUrl())) {
            $ogString .= sprintf('<meta property="og:video:secure_url" content="%s">', $ogVideo->getSecureUrl());
        }

        if (!empty($ogVideo->getType())) {
            $ogString .= sprintf('<meta property="og:video:type" content="%s" />', $ogVideo->getType());
        }

        if (!empty($ogVideo->getWidth())) {
            $ogString .= sprintf('<meta property="og:video:width" content="%s" />', $ogVideo->getWidth());
        }

        if (!empty($ogVideo->getHeight())) {
            $ogString .= sprintf('<meta property="og:video:height" content="%s" />', $ogVideo->getHeight());
        }

        return $ogString;
    }

    private function getOgArticle(): string
    {
        $article = $this->ogArticleManager->getArticle();

        $articleString = '';

        if (!empty($article->getPublishedTime())) {
            $articleString .= sprintf('<meta property="article:published_time" content="%s" />', $article->getPublishedTime()->format('Y-md-m-Y-H-i-s'));
        }

        if (!empty($article->getModifiedTime())) {
            $articleString .= sprintf('<meta property="article:modified_time" content="%s" />', $article->getModifiedTime()->format('Y-m-d-m-Y-H-i-s'));
        }

        if (!empty($article->getAuthor())) {
            $articleString .= sprintf('<meta property="article:author" content="%s" />', $article->getAuthor());
        }

        if (!empty($article->getSection())) {
            $articleString .= sprintf('<meta property="article:section" content="%s" />', $article->getSection());
        }

        if (!empty($article->getTags())) {
            foreach ($article->getTags() as $tag) {
                $articleString .= sprintf('<meta property="article:tag" content="%s" />', $tag);
            }
        }

        return $articleString;
    }
}