<?php

namespace Rami\SeoBundle\Schema\Thing\Intangible;

use Rami\SeoBundle\Schema\BaseType;

class ListItem extends BaseType
{
    public function position(int $position): static
    {
        $this->setProperty('position', $position);
        return $this;
    }

    public function item(string|BaseType $item): static
    {
        if ($item instanceof BaseType) {
            $this->setProperty('item', $this->parseChild($item));
        } else {
            $this->setProperty('item', $item);
        }
        return $this;
    }
}
