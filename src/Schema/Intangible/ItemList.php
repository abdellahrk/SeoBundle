<?php

namespace Rami\SeoBundle\Schema\Intangible;

use Rami\SeoBundle\Schema\Thing;

class ItemList extends Thing
{
    public function itemListElement(array $listitems): static
    {
        $this->setProperty('itemListElement', $this->parseArray($listitems));

        return $this;
    }

    public function numberOfItems(int $number): static
    {
        $this->setProperty('numberOfItems', $number);

        return $this;
    }
}