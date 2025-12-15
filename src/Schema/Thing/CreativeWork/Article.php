<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\ArticleTrait;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;
use Rami\SeoBundle\Schema\Traits\ThingTrait;

class Article extends BaseType
{
    use ThingTrait;
    use CreativeWorkTrait;
    use ArticleTrait;
}
