<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Metas;

use Rami\SeoBundle\Metas\Model\SeoMeta;
use Symfony\Component\Cache\ResettableInterface;

class MetaTagsManager implements MetaTagsManagerInterface, ResettableInterface
{
    public SeoMeta $seoMeta;

    /**
     * @var array<string, mixed>
     */
    private array $metaTags = [];

    public function __construct()
    {
        $this->seoMeta = new SeoMeta();
    }

    /**
     * @return array<string, mixed>
     */
    public function getMetaTags(): array
    {
        return $this->metaTags;
    }

    public function getSeoMeta(): SeoMeta
    {
        return $this->seoMeta;
    }

    public function setCharacterEncoding(string $charset = 'UTF-8'): static
    {
        $this->seoMeta->setCharset($charset);

        return $this;
    }

    /**
     * @return $this
     */
    public function setTitle(string $title): static
    {
        $this->seoMeta->setTitle($title);

        return $this;
    }

    /**
     * @return $this
     */
    public function setDescription(string $description): static
    {
        $this->seoMeta->setDescription($description);

        return $this;
    }

    /**
     * @param array<int, string> $keywords
     *
     * @return $this
     */
    public function setKeywords(array $keywords): static
    {
        $this->seoMeta->setKeywords($keywords);

        return $this;
    }

    /**
     * @return $this
     */
    public function setSubject(string $keyword): static
    {
        $this->seoMeta->setSubject($keyword);

        return $this;
    }

    /**
     * @return $this
     */
    public function setCopyright(string $copyright): static
    {
        $this->seoMeta->setCopyright($copyright);

        return $this;
    }

    /**
     * @param array<int, string> $robots
     *
     * @return $this
     */
    public function setRobots(array $robots): static
    {
        $this->seoMeta->setRobots($robots);

        return $this;
    }

    /**
     * @return $this
     */
    public function setViewPort(string $viewport): static
    {
        $this->seoMeta->setViewPort($viewport);

        return $this;
    }

    /**
     * @return $this
     */
    public function setCanonical(string $href): static
    {
        $this->seoMeta->setCanonical($href);

        return $this;
    }

    public function setAlternate(string $href, string $media = ''): static
    {
        $canonical['rel'] = 'canonical';
        $canonical['href'] = $href;
        $canonical['media'] = $media;
        $this->metaTags['rel'] = $canonical;

        return $this;
    }

    public function setContentSecurityPolicy(string $contentSecurityPolicy): static
    {
        $this->seoMeta->setContentSecurityPolicy($contentSecurityPolicy);

        return $this;
    }

    public function setContentType(string $contentType): static
    {
        $this->seoMeta->setContentType($contentType);

        return $this;
    }

    public function setDefaultStyle(string $style): static
    {
        $tags['http-equiv'] = 'Default-Style';
        $tags['value'] = $style;
        $this->metaTags['default-style'] = $tags;

        return $this;
    }

    public function setXUACompatible(): static
    {
        $tags['http-equiv'] = 'X-UA-Compatible';
        $tags['value'] = 'IE=edge';
        $this->metaTags['x-ua-compatible'] = $tags;

        return $this;
    }

    public function setCustomMetaTag(string $name, string $content): static
    {
        $this->metaTags[$name] = $content;

        return $this;
    }

    public function reset(): void
    {
        $this->metaTags = [];
        $this->seoMeta = new SeoMeta();
    }

    public function setAuthor(string $author): static
    {
        $this->seoMeta->setAuthor($author);

        return $this;
    }
}
