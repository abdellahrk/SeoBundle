<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Intangible;

use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject\ImageObject;

use function is_string;

class Brand extends Thing
{
    public function slogan(string $slogan): static
    {
        $this->setProperty('slogan', $slogan);

        return $this;
    }

    public function logo(ImageObject|string $logo): static
    {
        $this->setProperty('logo', is_string($logo) ? $logo : $this->parseChild($logo));

        return $this;
    }
}
