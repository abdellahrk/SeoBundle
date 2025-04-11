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

namespace Rami\SeoBundle\OpenGraph;

use Rami\SeoBundle\OpenGraph\Model\Audio;
use Rami\SeoBundle\OpenGraph\Model\Image;
use Symfony\Component\Cache\ResettableInterface;

class OGAudioManager implements OGAudioManagerInterface, ResettableInterface
{
    public Audio $audio;
    public function __construct()
    {
        $this->audio = new Audio();
    }

    public function getAudio(): Audio
    {
        return $this->audio;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->audio->getUrl();
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->audio->setUrl($url);
        return $this;
    }

    /**
     * @return string
     */
    public function getSecureUrl(): string
    {
        return $this->audio->getSecureUrl();
    }

    /**
     * @param string $secureUrl
     * @return $this
     */
    public function setSecureUrl(string $secureUrl): static
    {
        $this->audio->setSecureUrl($secureUrl);
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->audio->getType();
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->audio->setType($type);
        return $this;
    }

    /**
     * @return void
     */
    public function reset(): void
    {
        $this->audio = new Audio();
    }
}