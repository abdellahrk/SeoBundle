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

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article\SocialMediaPosting\BlogPosting;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;
use Rami\SeoBundle\Schema\Traits\ThingTrait;

class Blog extends CreativeWork
{
    use ThingTrait;
    use CreativeWorkTrait;

    public function __toString(): string
    {
        return 'Blog';
    }

    /**
     * @param BlogPosting $blogPosting
     * @return $this
     */
    public function blogPost(BlogPosting $blogPosting): static
    {
        $this->setProperty('blogPost', $this->parseChild($blogPosting));
        return $this;
    }

    /**
     * @param string $issn
     * @return $this
     */
    public function issn(string $issn): static
    {
        $this->setProperty('issn', $issn);
        return $this;
    }
}