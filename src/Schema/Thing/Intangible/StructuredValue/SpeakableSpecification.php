<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue;

use Rami\SeoBundle\Schema\BaseType;

class SpeakableSpecification extends BaseType
{
    public function cssSelector(array|string $selector): static
    {
        $this->setProperty('cssSelector', $selector);

        return $this;
    }

    public function xpath(array|string $xpath): static
    {
        $this->setProperty('xpath', $xpath);

        return $this;
    }
}
