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

namespace Rami\SeoBundle\Metas\Model;

class SeoMeta
{
    protected string $title = '';

    protected string $description = '';

    /**
     * @var array<int, string>
     */
    protected array $keywords = [];

    protected string $subject = '';

    /**
     * @var array<int, string>|null
     */
    protected array $robots = [];

    protected string $canonical = '';

    protected string $copyright = '';

    protected string $viewport = '';

    protected string $author = '';

    protected string $charset = '';

    protected string $contentType = '';

    protected ?string $contentSecurityPolicy = null;

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function getContentSecurityPolicy(): ?string
    {
        return $this->contentSecurityPolicy;
    }

    public function setContentSecurityPolicy(?string $contentSecurityPolicy): self
    {
        $this->contentSecurityPolicy = $contentSecurityPolicy;

        return $this;
    }

    public function getCharset(): ?string
    {
        return $this->charset;
    }

    public function setCharset(?string $charset): self
    {
        $this->charset = $charset;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return array<int, string>
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * @param array<int, string> $keywords
     */
    public function setKeywords(array $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return array<int, string>|null
     */
    public function getRobots(): ?array
    {
        return $this->robots;
    }

    /**
     * @param array<int, string>|null $robots
     */
    public function setRobots(?array $robots): self
    {
        $this->robots = $robots;

        return $this;
    }

    public function getCanonical(): ?string
    {
        return $this->canonical;
    }

    public function setCanonical(?string $canonical): self
    {
        $this->canonical = $canonical;

        return $this;
    }

    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    public function setCopyright(?string $copyright): self
    {
        $this->copyright = $copyright;

        return $this;
    }

    public function getViewport(): ?string
    {
        return $this->viewport;
    }

    public function setViewport(string $viewport): self
    {
        $this->viewport = $viewport;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }
}
