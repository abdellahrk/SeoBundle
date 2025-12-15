<?php

namespace Rami\SeoBundle\Schema\Traits;

use Rami\SeoBundle\Schema\Thing\CreativeWork;

trait ArticleTrait
{
    public function articleBody(string $body): static
    {
        $this->setProperty('articleBody', $body);
        return $this;
    }

    public function articleSection(string $section): static
    {
        $this->setProperty('articleSection', $section);
        return $this;
    }

    public function backstory(string|CreativeWork $backstory): static
    {
        if ($backstory instanceof CreativeWork) {
            $this->setProperty('backstory', $this->parseChild($backstory));
        } else {
            $this->setProperty('backstory', $backstory);
        }
        return $this;
    }

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

    public function wordCount(int $count): static
    {
        $this->setProperty('wordCount', $count);
        return $this;
    }

    public function headline(string $headline): static
    {
        $this->setProperty('headline', $headline);
        return $this;
    }
}
