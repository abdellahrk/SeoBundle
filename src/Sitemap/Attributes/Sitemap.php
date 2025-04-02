<?php

namespace Rami\SeoBundle\Sitemap\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD|Attribute::TARGET_FUNCTION)]
class Sitemap
{
    public function __construct(
        public readonly ?string $routeName = null
    ) {}
}