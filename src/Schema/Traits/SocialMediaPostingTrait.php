<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Traits;

use Rami\SeoBundle\Schema\Thing\CreativeWork\Article;

trait SocialMediaPostingTrait
{
    public function sharedContent(Article $article): static
    {
        $this->setProperty('sharedContent', $this->parseChild($article));

        return $this;
    }

    public function discussionUrl(string $url): static
    {
        $this->setProperty('discussionUrl', $url);

        return $this;
    }
}
