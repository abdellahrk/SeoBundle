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

use Rami\SeoBundle\OpenGraph\Model\Article;

class OGArticleManager implements OGArticleManagerInterface
{
    public Article $article;
    public function __construct()
    {
        $this->article = new Article();
    }

    /**
     * @return \DateTime
     */
    public function getPublishedTime(): \DateTime
    {
        return $this->article->getPublishedTime();
    }

    /**
     * @param \DateTime $publishedTime
     * @return $this
     */
    public function setPublishedTime(\DateTime $publishedTime): static
    {
        $this->setPublishedTime($publishedTime);
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getModifiedTime(): \DateTime
    {
        return $this->getModifiedTime();
    }

    /**
     * @param \DateTime $modifiedTime
     * @return $this
     */
    public function setModifiedTime(\DateTime $modifiedTime): static
    {
        $this->article->setModifiedTime($modifiedTime);
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->article->getAuthor();
    }

    /**
     * @param string $author
     * @return $this
     */
    public function setAuthor(string $author): static
    {
        $this->article->setAuthor($author);
        return $this;
    }

    /**
     * @return string
     */
    public function getSection(): string
    {
        return $this->article->getSection();
    }

    /**
     * @param string $section
     * @return $this
     */
    public function setSection(string $section): static
    {
        $this->article->setSection($section);
        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->article->getTags();
    }

    /**
     * @param array $tags
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