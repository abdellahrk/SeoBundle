<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\Thing\CreativeWork;

class WebPageElement extends CreativeWork
{
    public function cssSelector(string $selector): static
    {
        $this->setProperty('cssSelector', $selector);
        return $this;
    }

    public function xpath(string $xpath): static
    {
        $this->setProperty('xpath', $xpath);
        return $this;
    }
}
