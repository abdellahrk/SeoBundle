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

namespace Rami\SeoBundle\Metas\Model;

class SeoMeta
{
    protected ?string $title = null;

    protected ?string $description = null;

    protected ?array $keywords = [];

    protected ?string $subject = null;

    protected ?array $robots = [];

    protected ?string $canonical = null;

    protected ?string $copyright = null;

    protected ?string $viewport = null;

    protected ?string $author = null;

    protected ?string $charset = null;

    protected ?string $contentType = null;

    /**
     * @return string|null
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * @param string|null $contentType
     * @return SeoMeta
     */
    public function setContentType(?string $contentType): SeoMeta
    {
        $this->contentType = $contentType;
        return $this;
    }

    protected ?string $contentSecurityPolicy = null;

    /**
     * @return string|null
     */
    public function getContentSecurityPolicy(): ?string
    {
        return $this->contentSecurityPolicy;
    }

    /**
     * @param string|null $contentSecurityPolicy
     * @return SeoMeta
     */
    public function setContentSecurityPolicy(?string $contentSecurityPolicy): SeoMeta
    {
        $this->contentSecurityPolicy = $contentSecurityPolicy;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCharset(): ?string
    {
        return $this->charset;
    }

    /**
     * @param string|null $charset
     * @return SeoMeta
     */
    public function setCharset(?string $charset): SeoMeta
    {
        $this->charset = $charset;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return SeoMeta
     */
    public function setTitle(?string $title): SeoMeta
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return SeoMeta
     */
    public function setDescription(?string $description): SeoMeta
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getKeywords(): ?array
    {
        return $this->keywords;
    }

    /**
     * @param array|null $keywords
     * @return SeoMeta
     */
    public function setKeywords(?array $keywords): SeoMeta
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string|null $subject
     * @return SeoMeta
     */
    public function setSubject(?string $subject): SeoMeta
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getRobots(): ?array
    {
        return $this->robots;
    }

    /**
     * @param array|null $robots
     * @return SeoMeta
     */
    public function setRobots(?array $robots): SeoMeta
    {
        $this->robots = $robots;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getCanonical(): ?string
    {
        return $this->canonical;
    }

    /**
     * @param string|null $canonical
     * @return SeoMeta
     */
    public function setCanonical(?string $canonical): SeoMeta
    {
        $this->canonical = $canonical;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    /**
     * @param string|null $copyright
     * @return SeoMeta
     */
    public function setCopyright(?string $copyright): SeoMeta
    {
        $this->copyright = $copyright;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getViewport(): ?string
    {
        return $this->viewport;
    }

    /**
     * @param string|null $viewport
     * @return SeoMeta
     */
    public function setViewport(?string $width, string $scale): SeoMeta
    {
        $this->viewport = $width. ', ' . $scale;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     * @return SeoMeta
     */
    public function setAuthor(?string $author): SeoMeta
    {
        $this->author = $author;
        return $this;
    }





}