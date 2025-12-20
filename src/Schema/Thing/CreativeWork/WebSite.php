<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\Thing\CreativeWork;

class WebSite extends CreativeWork
{
    public function issn(string $ssn): static
    {
        $this->setProperty('issn', $ssn);

        return $this;
    }
}
