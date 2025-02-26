<?php

namespace Abdellahramadan\SeoBundle\Metas;

use Abdellahramadan\SeoBundle\Metas\MetaTagsInterface;
use Symfony\Component\Cache\ResettableInterface;

class MetaTags implements MetaTagsInterface, ResettableInterface
{
    public array $metaTags = [];

    public function reset(): void
    {
        $this->metaTags = [];
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

    public function setLanguage(string $language): static
    {
        $this->metaTags['language'] = $language;
        return $this;
    }

    public function setRobots(array $robots): static
    {
        $this->metaTags['robots'] = $robots;
        return $this;
    }
}