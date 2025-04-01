<?php

namespace Rami\SeoBundle\Schema\Traits;

trait CurrencyPropertiesTrait
{
    public function currency(string $currency): static
    {
        $this->setProperty('currency', $currency);
        return $this;
    }
}