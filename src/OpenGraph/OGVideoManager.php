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

use Rami\SeoBundle\OpenGraph\Model\Video;
use Symfony\Component\Cache\ResettableInterface;

class OGVideoManager implements OGVideoManagerInterface, ResettableInterface
{
    public Video $video;

    public function __construct()
    {
        $this->video = new Video();
    }

    public function getVideo(): Video
    {
        return $this->video;
    }

    public function getUrl(): string
    {
        return $this->video->getUrl();
    }

    /**
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->video->setUrl($url);

        return $this;
    }

    public function getSecureUrl(): string
    {
        return $this->video->getSecureUrl();
    }

    /**
     * @return $this
     */
    public function setSecureUrl(string $secureUrl): static
    {
        $this->video->setSecureUrl($secureUrl);

        return $this;
    }

    public function getType(): string
    {
        return $this->video->getType();
    }

    /**
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->video->setType($type);

        return $this;
    }

    public function getWidth(): string
    {
        return $this->video->getWidth();
    }

    /**
     * @return $this
     */
    public function setWidth(string $width): static
    {
        $this->video->setWidth($width);

        return $this;
    }

    public function getHeight(): string
    {
        return $this->video->getHeight();
    }

    /**
     * @return $this
     */
    public function setHeight(string $height): static
    {
        $this->video->setHeight($height);

        return $this;
    }

    public function reset(): void
    {
        $this->video = new Video();
    }
}
