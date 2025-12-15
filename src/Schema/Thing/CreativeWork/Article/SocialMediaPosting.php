<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork\Article;

use Rami\SeoBundle\Schema\Thing\CreativeWork\Article;
use Rami\SeoBundle\Schema\Thing\Organization;

class SocialMediaPosting extends Article
{
    public function sharedContent(Article $content): static
    {
        $this->setProperty('sharedContent', $this->parseChild($content));
        return $this;
    }

    public function discussionUrl(string $url): static
    {
        $this->setProperty('discussionUrl', $url);
        return $this;
    }
}
