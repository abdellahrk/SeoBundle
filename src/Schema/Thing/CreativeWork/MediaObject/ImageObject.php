<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject;

use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject;

class ImageObject extends MediaObject
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

    public function thumbnail(self $imageObject): static
    {
        $this->setProperty('thumbnail', $this->parseChild($imageObject));

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
