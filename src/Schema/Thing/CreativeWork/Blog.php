<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article\SocialMediaPosting\BlogPosting;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;

class Blog extends BaseType
{
    use CreativeWorkTrait;

    public function __toString(): string
    {
        return 'BlogPosting';
    }

    public function blogPost(BlogPosting $blogPosting): static
    {
        $this->setProperty('blogPosting', $this->parseChild($blogPosting));
        return $this;
    }

    public function issn(string $issn): static
    {
        $this->setProperty('issn', $issn);
        return $this;
    }
}