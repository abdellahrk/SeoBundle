<?php

namespace Rami\SeoBundle\Schema\Thing\Intangible;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Thing\Intangible\ListItem;

class BreadcrumbList extends BaseType
{
    public function itemListElement(array $items): static
    {
        $this->setProperty('itemListElement', $this->parseArray($items));
        return $this;
    }

    public function numberOfItems(int $count): static
    {
        $this->setProperty('numberOfItems', $count);
        return $this;
    }
}
