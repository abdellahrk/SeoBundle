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

namespace Rami\SeoBundle\OpenGraph\Model;

class Video
{
    protected string $url = '';
    protected string $secureUrl = '';
    protected string $type = '';
    protected string $width = '';
    protected string $height = '';

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Video
     */
    public function setUrl(string $url): Video
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecureUrl(): string
    {
        return $this->secureUrl;
    }

    /**
     * @param string $secureUrl
     * @return Video
     */
    public function setSecureUrl(string $secureUrl): Video
    {
        $this->secureUrl = $secureUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Video
     */
    public function setType(string $type): Video
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getWidth(): string
    {
        return $this->width;
    }

    /**
     * @param string $width
     * @return Video
     */
    public function setWidth(string $width): Video
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeight(): string
    {
        return $this->height;
    }

    /**
     * @param string $height
     * @return $this
     */
    public function setHeight(string $height): Video
    {
        $this->height = $height;
        return $this;
    }

}