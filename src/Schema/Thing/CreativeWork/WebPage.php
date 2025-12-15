<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;
use Rami\SeoBundle\Schema\Traits\ThingTrait;
use Rami\SeoBundle\Schema\Traits\WebPageTrait;

class WebPage extends BaseType
{
    use ThingTrait;
    use CreativeWorkTrait;
    use WebPageTrait;
}
