<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing\CreativeWork;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Thing\CreativeWork\Article\SocialMediaPosting\BlogPosting;
use Abdellahramadan\SeoBundle\Schema\Traits\CreativeWorkTrait;

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