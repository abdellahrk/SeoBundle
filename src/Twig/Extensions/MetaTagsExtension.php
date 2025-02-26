<?php

namespace Abdellahramadan\SeoBundle\Twig\Extensions;

use Abdellahramadan\SeoBundle\Metas\MetaTagsInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MetaTagsExtension extends AbstractExtension
{
    public function __construct(private readonly MetaTagsInterface $metaTags){}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('meta_tags', [$this, 'renderMetaTags'], ['is_safe' => ['html']]),
        ];
    }

    public function renderMetaTags(): string
    {
        $metaTags = '';
       foreach ($this->metaTags as $metaTag) {
            foreach ($metaTag as $tag => $value) {
                if (is_array($value)) {
                    $metaTags .= sprintf('<meta name="%s" content="%s">', $tag, implode(',', $value));
                    continue;
                }
                $metaTags .= sprintf('<meta name="%s" content="%s">', $tag, $value);
            }
       }
       return $metaTags;
    }
}