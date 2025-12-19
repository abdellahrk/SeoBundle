<?php

declare(strict_types=1);

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

    public function nextItem(self $listItem): static
    {
        $this->setProperty('nextItem', $this->parseChild($listItem));

        return $this;
    }

    public function position(int|string $position): static
    {
        $this->setProperty('position', $position);

        return $this;
    }

    public function previousItem(self $listItem): static
    {
        $this->setProperty('previousItem', $this->parseChild($listItem));

        return $this;
    }
}
