<?php

namespace Rami\SeoBundle\Schema\Traits;

use Rami\SeoBundle\Schema\Thing\CreativeWork\Article;

trait SocialMediaPostingTrait
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