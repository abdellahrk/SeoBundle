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

interface OGArticleManagerInterface
{
    public function getArticle(): Article;
    public function getPublishedTime(): \DateTime;
    public function setPublishedTime(\DateTime $publishedTime): static;

    public function getModifiedTime(): \DateTime;

    public function setModifiedTime(\DateTime $modifiedTime): static;

    public function getAuthor(): string;
    public function setAuthor(string $author): static;
    public function getSection(): string;
    public function setSection(string $section): static;
    public function getTags(): array;
    public function setTags(array $tags): static;
}