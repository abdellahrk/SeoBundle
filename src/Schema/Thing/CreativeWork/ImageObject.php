<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;

class ImageObject extends CreativeWork
{
    public function caption(string $caption): static
    {
        $this->setProperty('caption', $caption);
        return $this;
    }

    public function exifData(string $exifData): static
    {
        $this->setProperty('exifData', $exifData);
        return $this;
    }

    public function representativeOfPage(bool $value): static
    {
        $this->setProperty('representativeOfPage', $value);
        return $this;
    }

    public function thumbnail(ImageObject $thumbnail): static
    {
        $this->setProperty('thumbnail', $this->parseChild($thumbnail));
        return $this;
    }

    public function contentUrl(string $url): static
    {
        $this->setProperty('contentUrl', $url);
        return $this;
    }

    public function width(int|string $width): static
    {
        $this->setProperty('width', $width);
        return $this;
    }

    public function height(int|string $height): static
    {
        $this->setProperty('height', $height);
        return $this;
    }
}
