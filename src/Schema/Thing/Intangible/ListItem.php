<?php

namespace Rami\SeoBundle\Schema\Thing\Intangible;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Thing;

class ListItem extends Thing
{
    public function item(string|BaseType $item): static
    {
        if ($item instanceof BaseType) {
            $this->setProperty('item', $this->parseChild($item));
        } else {
            $this->setProperty('item', $item);
        }
        return $this;
    }

    public function nextItem(ListItem $nextItem): static
    {
        $this->setProperty('nextItem', $this->parseChild($nextItem));
        return $this;
    }

    public function position(int|string $position): static
    {
        $this->setProperty('position', $position);
        return $this;
    }

    public function previousItem(ListItem $previousItem): static
    {
        $this->setProperty('previousItem', $this->parseChild($previousItem));
        return $this;
    }
}
