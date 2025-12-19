<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Intangible;

use Rami\SeoBundle\Schema\DataType\Text\Url;
use Rami\SeoBundle\Schema\Thing;

use function is_string;

class Offer extends Thing
{
    public function asin(string|Url $asin): static
    {
        $this->setProperty('asin', is_string($asin) ? $asin : $this->parseChild($asin));

        return $this;
    }

    public function price(float|string $price): static
    {
        $this->setProperty('price', $price);

        return $this;
    }

    public function priceCurrency(string $currency): static
    {
        $this->setProperty('priceCurrency', $currency);

        return $this;
    }
}
