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

use DateTime;

class Article
{
    protected ?DateTime $publishedTime = null;

    protected ?DateTime $modifiedTime = null;

    protected string $author = '';

    protected string $section = '';

    protected array $tags = [];

    /**
     * @return DateTime|null
     */
    public function getPublishedTime(): ?DateTime
    {
        return $this->publishedTime;
    }

    /**
     * @param DateTime|null $publishedTime
     * @return Article
     */
    public function setPublishedTime(?DateTime $publishedTime): Article
    {
        $this->publishedTime = $publishedTime;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getModifiedTime(): ?DateTime
    {
        return $this->modifiedTime;
    }

    /**
     * @param DateTime|null $modifiedTime
     * @return Article
     */
    public function setModifiedTime(?DateTime $modifiedTime): Article
    {
        $this->modifiedTime = $modifiedTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Article
     */
    public function setAuthor(string $author): Article
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getSection(): string
    {
        return $this->section;
    }

    /**
     * @param string $section
     * @return Article
     */
    public function setSection(string $section): Article
    {
        $this->section = $section;
        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return Article
     */
    public function setTags(array $tags): Article
    {
        $this->tags = $tags;
        return $this;
    }
}