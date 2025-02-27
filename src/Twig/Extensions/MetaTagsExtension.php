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
            new TwigFunction('lang_head_value', [$this, 'renderHeadLang'], ['is_safe' => ['html']]),
        ];
    }

    public function renderHeadLang(string $lang): string
    {
        return 'lang="'.$lang.'"';
    }

    public function renderMetaTags(): string
    {
        $metaTags = '';
       foreach ($this->metaTags as $metaTag) {
            foreach ($metaTag as $tag => $value) {
                if ($tag === 'charset') {
                    $metaTags .= sprintf('<meta charset="%s" />', $value);
                    continue;
                }
                if ($tag === 'title') {
                    $metaTags .= sprintf('<title>%s</title>', $value);
                    continue;
                }

                if (is_array($value) && array_key_exists('rel', $value)) {
                    if (array_key_exists('media', $value)) {
                        $metaTags .= sprintf('<link rel="%s" href="%s"  media="%s"/>', $value['rel'], $value['href'], $value['media']);
                        continue;
                    }

                    $metaTags .= sprintf('<link rel="%s" href="%s"  />', $value['rel'], $value['href']);
                    continue;
                }

                if (is_array($value)) {
                    $metaTags .= sprintf('<meta name="%s" content="%s">', $tag, implode(', ', $value));
                    continue;
                }

                $metaTags .= sprintf('<meta name="%s" content="%s">', $tag, $value);
            }
       }
       return $metaTags;
    }
}