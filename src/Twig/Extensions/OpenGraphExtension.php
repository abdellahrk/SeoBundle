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

use DateTime;
use Rami\SeoBundle\OpenGraph\OGArticleManagerInterface;
use Rami\SeoBundle\OpenGraph\OGImageManagerInterface;
use Rami\SeoBundle\OpenGraph\OGVideoManagerInterface;
use Rami\SeoBundle\OpenGraph\OpenGraphManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Attribute\AsTwigFunction;

use function array_key_exists;
use function sprintf;

final readonly class OpenGraphExtension
{
    public function __construct(
        private OpenGraphManagerInterface $openGraphManager,
        private OGImageManagerInterface $ogImageManager,
        private OGVideoManagerInterface $ogVideoManager,
        private OGArticleManagerInterface $ogArticleManager,
        private ParameterBagInterface $parameterBag
    ) {
    }

    #[AsTwigFunction('open_graph', isSafe: ['html'])]
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
    ): string {
        $openGraph = $this->openGraphManager->getOpenGraph();
        $openGraph->setTitle($title ?: $openGraph->getTitle())
            ->setDescription($description ?: $openGraph->getDescription())
            ->setSiteName($siteName ?: $openGraph->getSiteName())
            ->setImageUrl($imageUrl ?: $openGraph->getImageUrl())
            ->setImageAlt($imageAlt ?: $openGraph->getImageAlt())
            ->setUrl($url ?: $openGraph->getUrl())
            ->setType($type ?: $openGraph->getType())
            ->setLocale($locale ?: $openGraph->getLocale())
            ->setAlternateLocale($alternateLocale ?: $openGraph->getAlternateLocale())
            ->setAudio($audio ?: $openGraph->getAudio())
            ->setVideo($video ?: $openGraph->getVideo());

        return $this->getOG();
    }

    #[AsTwigFunction('og_image', isSafe: ['html'])]
    public function renderOgImage(
        ?string $url = '',
        ?string $secureUrl = '',
        ?string $alt = '',
        ?string $type = '',
        ?string $width = '',
        ?string $height = '',
    ): string {
        $image = $this->ogImageManager->getImage();

        $image
            ->setUrl($url ?: $image->getUrl())
            ->setSecureUrl($secureUrl ?: $image->getSecureUrl())
            ->setAlt($alt ?: $image->getAlt())
            ->setType($type ?: $image->getType())
            ->setWidth($width ?: $image->getWidth())
            ->setHeight($height ?: $image->getHeight())
        ;

        return $this->getOgImage();
    }

    #[AsTwigFunction('og_video', isSafe: ['html'])]
    public function renderOgVideo(
        ?string $url = '',
        ?string $secureUrl = '',
        ?string $alt = '',
        ?string $type = '',
        ?string $width = '',
        ?string $height = '',
    ): string {
        $video = $this->ogVideoManager->getVideo();

        $video
            ->setUrl($url ?: $video->getUrl())
            ->setSecureUrl($secureUrl ?: $video->getSecureUrl())
            ->setType($type ?: $video->getType())
            ->setWidth($width ?: $video->getWidth())
            ->setHeight($height ?: $video->getHeight())
        ;

        return $this->getOgVideo();
    }

    /**
     * @param array<int, string>|null $tags
     */
    #[AsTwigFunction('og_article', isSafe: ['html'])]
    public function renderOgArticle(
        ?DateTime $publishedTime = null,
        ?DateTime $modifiedTime = null,
        ?string $author = '',
        ?string $section = '',
        ?array $tags = []
    ): string {
        $article = $this->ogArticleManager->getArticle();

        $article
            ->setPublishedTime($publishedTime ?: $article->getPublishedTime())
            ->setModifiedTime($modifiedTime ?: $article->getModifiedTime())
            ->setAuthor($author ?: $article->getAuthor())
            ->setSection($section ?: $article->getSection())
            ->setTags($tags ?: $article->getTags())
        ;

        return $this->getOgArticle();
    }

    private function getOG(): string
    {
        $openGraphString = '';
        $hasDefaultConfig = false;
        $openGraph = $this->openGraphManager->getOpenGraph();

        $openGraphConfig = $this->parameterBag->has('seo.open_graph') ? $this->parameterBag->get('seo.open_graph') : null;
        if (null !== $openGraphConfig && [] !== $openGraphConfig) {
            $hasDefaultConfig = true;
        }

        if ($hasDefaultConfig) {
            $defaults = $this->parameterBag->get('seo.open_graph');
            assert(is_array($defaults));
            if ('' === $openGraph->getTitle() && array_key_exists('title', $defaults)) {
                $title = $defaults['title'];
                assert(is_string($title));
                $openGraph->setTitle($title);
            }

            if ('' === $openGraph->getDescription() && array_key_exists('description', $defaults)) {
                $description = $defaults['description'];
                assert(is_string($description));
                $openGraph->setDescription($description);
            }

            if ((null === $openGraph->getSiteName() || '' === $openGraph->getSiteName()) && array_key_exists('sitename', $defaults)) {
                $openGraph->setSiteName($defaults['sitename']);
            }

            if ((null === $openGraph->getUrl() || '' === $openGraph->getUrl()) && array_key_exists('url', $defaults)) {
                $openGraph->setUrl($defaults['url']);
            }

            if ((null === $openGraph->getType() || '' === $openGraph->getType()) && array_key_exists('type', $defaults)) {
                $openGraph->setType($defaults['type']);
            }
        }

        if ('' !== $openGraph->getTitle()) {
            $openGraphString .= sprintf('<meta property="og:title" content="%s" />', strip_tags($openGraph->getTitle()));
        }

        if ('' !== $openGraph->getDescription()) {
            $openGraphString .= sprintf('<meta property="og:description" content="%s" />', strip_tags($openGraph->getDescription()));
        }

        if ('' !== $openGraph->getImageUrl()) {
            $openGraphString .= sprintf('<meta property="og:image" content="%s" />', strip_tags($openGraph->getImageUrl()));
        }

        if ('' !== $openGraph->getUrl()) {
            $openGraphString .= sprintf('<meta property="og:url" content="%s" />', strip_tags($openGraph->getUrl()));
        }

        if ('' !== $openGraph->getType()) {
            $openGraphString .= sprintf('<meta property="og:type" content="%s" />', strip_tags($openGraph->getType()));
        }

        if ('' !== $openGraph->getSiteName()) {
            $openGraphString .= sprintf('<meta property="og:site_name" content="%s" />', $openGraph->getSiteName());
        }

        if ($openGraph->getStructuredProperties()) {
            foreach ($openGraph->getStructuredProperties() as $value) {
                $openGraphString .= sprintf('<meta property="og:%s" content="%s" />', $value[0]['type'], $value[0]['content']);
                foreach ($value as $structuredProperty) {
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

        foreach ($openGraph->getTwitterCardProperties() as $twitterCardProperty) {
            foreach ($twitterCardProperty as $name => $content) {
                $openGraphString .= sprintf('<meta property=twitter:"%s" content="%s" />', $name, $content);
            }
        }

        return $openGraphString;
    }

    private function getOgImage(): string
    {
        $ogImage = $this->ogImageManager->getImage();

        $ogString = '';

        if ('' !== $ogImage->getUrl()) {
            $ogString .= sprintf('<meta property="og:image" content="%s" />', $ogImage->getUrl());
        }

        if ('' !== $ogImage->getSecureUrl()) {
            $ogString .= sprintf('<meta property="og:image:secure_url" content="%s">', $ogImage->getSecureUrl());
        }

        if ('' !== $ogImage->getType()) {
            $ogString .= sprintf('<meta property="og:image:type" content="%s" />', $ogImage->getType());
        }

        if ('' !== $ogImage->getWidth()) {
            $ogString .= sprintf('<meta property="og:image:width" content="%s" />', $ogImage->getWidth());
        }

        if ('' !== $ogImage->getHeight()) {
            $ogString .= sprintf('<meta property="og:image:height" content="%s" />', $ogImage->getHeight());
        }

        if ('' !== $ogImage->getAlt()) {
            $ogString .= sprintf('<meta property="og:image:alt" content="%s" />', $ogImage->getAlt());
        }

        return $ogString;
    }

    private function getOgVideo(): string
    {
        $ogVideo = $this->ogVideoManager->getVideo();

        $ogString = '';

        if ('' !== $ogVideo->getUrl()) {
            $ogString .= sprintf('<meta property="og:video" content="%s" />', $ogVideo->getUrl());
        }

        if ('' !== $ogVideo->getSecureUrl()) {
            $ogString .= sprintf('<meta property="og:video:secure_url" content="%s">', $ogVideo->getSecureUrl());
        }

        if ('' !== $ogVideo->getType()) {
            $ogString .= sprintf('<meta property="og:video:type" content="%s" />', $ogVideo->getType());
        }

        if ('' !== $ogVideo->getWidth()) {
            $ogString .= sprintf('<meta property="og:video:width" content="%s" />', $ogVideo->getWidth());
        }

        if ('' !== $ogVideo->getHeight()) {
            $ogString .= sprintf('<meta property="og:video:height" content="%s" />', $ogVideo->getHeight());
        }

        return $ogString;
    }

    private function getOgArticle(): string
    {
        $article = $this->ogArticleManager->getArticle();

        $articleString = '';

        if ($article->getPublishedTime() instanceof DateTime) {
            $articleString .= sprintf('<meta property="article:published_time" content="%s" />', $article->getPublishedTime()->format('Y-md-m-Y-H-i-s'));
        }

        if ($article->getModifiedTime() instanceof DateTime) {
            $articleString .= sprintf('<meta property="article:modified_time" content="%s" />', $article->getModifiedTime()->format('Y-m-d-m-Y-H-i-s'));
        }

        if ('' !== $article->getAuthor()) {
            $articleString .= sprintf('<meta property="article:author" content="%s" />', $article->getAuthor());
        }

        if ('' !== $article->getSection()) {
            $articleString .= sprintf('<meta property="article:section" content="%s" />', $article->getSection());
        }

        foreach ($article->getTags() as $tag) {
            $articleString .= sprintf('<meta property="article:tag" content="%s" />', $tag);
        }

        return $articleString;
    }
}
