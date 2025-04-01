<?php

namespace Rami\SeoBundle\Metas;

use Symfony\Component\Cache\ResettableInterface;

class MetaTags implements MetaTagsInterface, ResettableInterface
{
    private array $metaTags = [];

    public function getMetaTags(): array
    {
        return $this->metaTags;
    }

    public function reset(): void
    {
        $this->metaTags = [];
    }

    public function setCharacterEncoding(string $charset = 'UTF-8'): static
    {
       $this->metaTags['charset'] = $charset;
       return $this;
    }

    public function setTitle(string $title): static
    {
        $this->metaTags['title'] = $title;
        return $this;
    }

    public function setDescription(string $description): static
    {
        $this->metaTags['description'] = $description;
        return $this;
    }

    public function setKeywords(array $keywords): static
    {
        $this->metaTags['keywords'] = $keywords;
        return $this;
    }

    public function setSubject(string $keyword): static
    {
       $this->metaTags['subject'] = $keyword;
       return $this;
    }

    public function setCopyright(string $copyright): static
    {
        $this->metaTags['copyright'] = $copyright;
        return $this;
    }


    public function setRobots(array $robots): static
    {
        $this->metaTags['robots'] = $robots;
        return $this;
    }

    public function setViewPort(string $viewPort): static
    {
        $this->metaTags['viewport'] = $viewPort;
        return $this;
    }

    /*
     * @params
     */
    public function setCanonical(string $href): static
    {
       $canonical['rel'] = 'canonical';
       $canonical['href'] = $href;
       $this->metaTags['canonical'] = $canonical;
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
        $tags['http-equiv'] = 'Content-Security-Policy';
        $tags['value'] = $contentSecurityPolicy;
        $this->metaTags['content-security-policy'] = $tags;
        return $this;
    }

    public function setContentType(string $contentType): static
    {
        $tags['http-equiv'] = 'Content-Type';
        $tags['value'] = $contentType;
        $this->metaTags['content-type'] = $tags;
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
        $tags['value'] = "IE=edge";
        $this->metaTags['x-ua-compatible'] = $tags;
        return $this;
    }

    public function setPragmaRefresh(int $seconds, string $url = ''): static
    {
        $value = $seconds . $url ?? ';'.$url;
        $tags['http-equiv'] = 'Refresh';
        $tags['value'] = $value ;
        $this->metaTags['default-style'] = $tags;
        return $this;
    }

    public function setCustomMetaTag(string $name, string $content): static
    {
        $this->metaTags[$name] = $content;
        return $this;
    }
}