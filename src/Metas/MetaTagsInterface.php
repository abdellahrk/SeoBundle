<?php

namespace Abdellahramadan\SeoBundle\Metas;

interface MetaTagsInterface
{
    public function setTitle(string $title): static;
    public function setDescription(string $description): static;
    public function setKeywords(array $keywords): static;

    public function setSubject(string $keyword): static;
    public function setCopyright(string $copyright): static;
    public function setLanguage(string $language): static;
    public function setRobots(array $robots): static;
    public function setRevised(string $revised): static;
}