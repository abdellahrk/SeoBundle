<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\CreativeWork\Article;

use Rami\SeoBundle\Schema\Thing\CreativeWork\Article;
use Rami\SeoBundle\Schema\Traits\SocialMediaPostingTrait;

class SocialMediaPosting extends Article
{
    use SocialMediaPostingTrait;

    public array $properties = [];
}
