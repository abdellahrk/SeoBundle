<?php

namespace Rami\SeoBundle\Metas;

interface MetaTagsInterface
{
    public function getMetaTags(): array;
    public function setTitle(string $title): static;
    public function setDescription(string $description): static;
    public function setKeywords(array $keywords): static;

    public function setSubject(string $keyword): static;
    public function setCopyright(string $copyright): static;
    public function setRobots(array $robots): static;
    public function setCharacterEncoding(string $charset): static;
    public function setViewPort(string $viewPort): static;
    public function setCanonical(string $href): static;
    public function setAlternate(string $href, string $media = ''): static;

    public function setContentSecurityPolicy(string $contentSecurityPolicy): static;
    public function setContentType(string $contentType): static;
    public function setDefaultStyle(string $style): static;
    public function setXUACompatible(): static;
    public function setPragmaRefresh(int $seconds, string $url): static;
    public function setCustomMetaTag(string $name, string $content): static;
}