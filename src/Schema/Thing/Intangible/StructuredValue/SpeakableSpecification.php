<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue;

use Rami\SeoBundle\Schema\BaseType;

class SpeakableSpecification extends BaseType
{
    /**
     * @param array<int, string>|string $selector
     */
    public function cssSelector(array|string $selector): static
    {
        $this->setProperty('cssSelector', $selector);

        return $this;
    }

    /**
     * @param array<int, string>|string $xpath
     */
    public function xpath(array|string $xpath): static
    {
        $this->setProperty('xpath', $xpath);

        return $this;
    }
}
