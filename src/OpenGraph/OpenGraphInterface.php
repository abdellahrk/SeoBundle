<?php

namespace Rami\SeoBundle\OpenGraph;

interface OpenGraphInterface
{
    public function setTitle(string $title): static;
    public function getTitle(): string;

    public function getDescription(): string;
    public function setDescription(string $description): static;

    public function setImage(string $image): static;
    public function getImage(): string;
    public function setUrl(string $url): static;
    public function getUrl(): string;
    public function setType(string $type): static;
    public function getType(): string;
    public function addStructuredProperty(string $type, string $property, string $content): static;
    public function getStructuredProperties(): array;
    public function setSiteName(string $siteName): static;
    public function getSiteName(): string;
    public function setLocale(string $locale): static;
    public function getLocale(): string;
    public function setAlternateLocale(string $alternateLocale): static;
    public function getAlternateLocale(): string;

    public function addMusicProperty(string $property, string $content): static;
    public function getMusicProperties(): array;

    public function addTwitterCardProperty(string $name, string $content): static;

    public function getTwitterCardProperties(): array;
}