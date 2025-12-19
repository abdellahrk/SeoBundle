<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Metas\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
readonly class Title
{
    public function __construct(public readonly string $title)
    {
    }
}
