<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing\CreativeWork;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Traits\CreativeWorkTrait;

class Chapter extends BaseType
{
    use CreativeWorkTrait;

    public function pageEnd(string|int $pageEnd): static
    {
        $this->setProperty('pageEnd', $pageEnd);
        return $this;
    }

    public function pageStart(string|int $pageStart): static
    {
        $this->setProperty('pageStart', $pageStart);
        return $this;
    }

    public function pagination(string $pagination): static
    {
        $this->setProperty('pagination', $pagination);
        return $this;
    }
}