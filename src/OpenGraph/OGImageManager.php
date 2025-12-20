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

namespace Rami\SeoBundle\OpenGraph;

use Rami\SeoBundle\OpenGraph\Model\Image;
use Symfony\Component\Cache\ResettableInterface;

class OGImageManager implements OGImageManagerInterface, ResettableInterface
{
    public Image $image;

    public function __construct()
    {
        $this->image = new Image();
    }

    public function getImage(): Image
    {
        return $this->image;
    }

    public function getUrl(): string
    {
        return $this->image->getUrl();
    }

    /**
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->image->setUrl($url);

        return $this;
    }

    public function getSecureUrl(): string
    {
        return $this->image->getSecureUrl();
    }

    /**
     * @return $this
     */
    public function setSecureUrl(string $secureUrl): static
    {
        $this->image->setSecureUrl($secureUrl);

        return $this;
    }

    public function getType(): string
    {
        return $this->image->getType();
    }

    /**
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->image->setType($type);

        return $this;
    }

    public function getWidth(): string
    {
        return $this->image->getWidth();
    }

    /**
     * @return $this
     */
    public function setWidth(string $width): static
    {
        $this->image->setWidth($width);

        return $this;
    }

    public function getHeight(): string
    {
        return $this->image->getHeight();
    }

    /**
     * @return $this
     */
    public function setHeight(string $height): static
    {
        $this->image->setHeight($height);

        return $this;
    }

    public function getAlt(): string
    {
        return $this->image->getAlt();
    }

    /**
     * @return $this
     */
    public function setAlt(string $alt): static
    {
        $this->image->setAlt($alt);

        return $this;
    }

    public function reset(): void
    {
        $this->image = new Image();
    }
}
