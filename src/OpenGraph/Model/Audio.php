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

class Audio
{
    protected string $url = '';
    protected string $secureUrl = '';
    protected string $type = '';

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Audio
     */
    public function setUrl(string $url): Audio
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
     * @return Audio
     */
    public function setSecureUrl(string $secureUrl): Audio
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
     * @return Audio
     */
    public function setType(string $type): Audio
    {
        $this->type = $type;
        return $this;
    }

}