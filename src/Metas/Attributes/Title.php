<?php

namespace Rami\SeoBundle\Metas\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
class Title
{
    public function __construct(public readonly string $title) {}
}