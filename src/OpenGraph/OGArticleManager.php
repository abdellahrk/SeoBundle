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

use DateTime;
use Rami\SeoBundle\OpenGraph\Model\Article;

class OGArticleManager implements OGArticleManagerInterface
{
    public Article $article;

    public function __construct()
    {
        $this->article = new Article();
    }

    public function getPublishedTime(): DateTime
    {
        return $this->article->getPublishedTime();
    }

    /**
     * @return $this
     */
    public function setPublishedTime(DateTime $publishedTime): static
    {
        $this->article->setPublishedTime($publishedTime);

        return $this;
    }

    public function getModifiedTime(): DateTime
    {
        return $this->article->getModifiedTime();
    }

    /**
     * @return $this
     */
    public function setModifiedTime(DateTime $modifiedTime): static
    {
        $this->article->setModifiedTime($modifiedTime);

        return $this;
    }

    public function getAuthor(): string
    {
        return $this->article->getAuthor();
    }

    /**
     * @return $this
     */
    public function setAuthor(string $author): static
    {
        $this->article->setAuthor($author);

        return $this;
    }

    public function getSection(): string
    {
        return $this->article->getSection();
    }

    /**
     * @return $this
     */
    public function setSection(string $section): static
    {
        $this->article->setSection($section);

        return $this;
    }

    public function getTags(): array
    {
        return $this->article->getTags();
    }

    /**
     * @return $this
     */
    public function setTags(array $tags): static
    {
        $this->article->setTags($tags);

        return $this;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }
}
