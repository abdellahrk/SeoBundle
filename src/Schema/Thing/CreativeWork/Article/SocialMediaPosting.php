<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork\Article;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\ArticleTrait;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;
use Rami\SeoBundle\Schema\Traits\SocialMediaPostingTrait;
use Rami\SeoBundle\Schema\Traits\ThingTrait;

class SocialMediaPosting extends BaseType
{
    use ThingTrait;
    use CreativeWorkTrait;
    use ArticleTrait;
    use SocialMediaPostingTrait;

    public array $properties = [];
}
