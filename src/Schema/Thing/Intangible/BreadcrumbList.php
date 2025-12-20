<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Intangible;

use Rami\SeoBundle\Schema\BaseType;

class BreadcrumbList extends BaseType
{
    /**
     * @param array<int, mixed> $items
     */
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
