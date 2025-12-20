<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Intangible;

use Rami\SeoBundle\Schema\Thing;

class DefinedTerm extends Thing
{
    public function termCode(string $code): static
    {
        $this->setProperty('termCode', $code);

        return $this;
    }
}
