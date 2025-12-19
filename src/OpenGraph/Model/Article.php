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

namespace Rami\SeoBundle\OpenGraph\Model;

use DateTime;

class Article
{
    protected ?DateTime $publishedTime = null;

    protected ?DateTime $modifiedTime = null;

    protected string $author = '';

    protected string $section = '';

    protected array $tags = [];

    public function getPublishedTime(): ?DateTime
    {
        return $this->publishedTime;
    }

    public function setPublishedTime(?DateTime $publishedTime): self
    {
        $this->publishedTime = $publishedTime;

        return $this;
    }

    public function getModifiedTime(): ?DateTime
    {
        return $this->modifiedTime;
    }

    public function setModifiedTime(?DateTime $modifiedTime): self
    {
        $this->modifiedTime = $modifiedTime;

        return $this;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getSection(): string
    {
        return $this->section;
    }

    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }
}
