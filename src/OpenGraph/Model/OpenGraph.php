<?php

declare(strict_types=1);

/*
 * Copyright (c) 2025.
 *
 * This file is part of the SEO Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\SeoBundle\OpenGraph\Model;

class OpenGraph
{
    protected string $title = '';

    protected string $description = '';

    protected string $imageUrl = '';

    protected string $imageAlt = '';

    protected string $url = '';

    protected string $type = '';

    protected string $locale = '';

    protected string $alternateLocale = '';

    protected string $siteName = '';

    protected string $audio = '';

    protected string $video = '';

    /**
     * @var array<string, mixed>
     */
    protected array $structuredProperty = [
        'type' => null,
        'property' => null,
        'content' => null,
    ];

    /**
     * @var array<int|string, mixed>
     */
    protected array $structuredProperties = [];

    /**
     * @var array<string, mixed>
     */
    protected array $musicProperties = [];

    /**
     * @var array<int, array<string, mixed>>
     */
    protected array $twitterCardProperties = [];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getAlternateLocale(): string
    {
        return $this->alternateLocale;
    }

    public function setAlternateLocale(string $alternateLocale): self
    {
        $this->alternateLocale = $alternateLocale;

        return $this;
    }

    public function getSiteName(): string
    {
        return $this->siteName;
    }

    public function setSiteName(string $siteName): self
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getStructuredProperty(): array
    {
        return $this->structuredProperty;
    }

    /**
     * @param array<string, mixed> $structuredProperty
     */
    public function setStructuredProperty(array $structuredProperty): self
    {
        $this->structuredProperty = $structuredProperty;

        return $this;
    }

    /**
     * @return array<int|string, mixed>
     */
    public function getStructuredProperties(): array
    {
        return $this->structuredProperties;
    }

    /**
     * @param array<int|string, mixed> $structuredProperties
     */
    public function setStructuredProperties(array $structuredProperties): self
    {
        $this->structuredProperties = $structuredProperties;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getMusicProperties(): array
    {
        return $this->musicProperties;
    }

    /**
     * @param array<string, mixed> $musicProperties
     */
    public function setMusicProperties(array $musicProperties): self
    {
        $this->musicProperties = $musicProperties;

        return $this;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getTwitterCardProperties(): array
    {
        return $this->twitterCardProperties;
    }

    /**
     * @param array<string, mixed> $twitterCardProperties
     */
    public function setTwitterCardProperties(array $twitterCardProperties): self
    {
        $this->twitterCardProperties[] = $twitterCardProperties;

        return $this;
    }

    public function getImageAlt(): string
    {
        return $this->imageAlt;
    }

    public function setImageAlt(string $imageAlt): self
    {
        $this->imageAlt = $imageAlt;

        return $this;
    }

    public function getAudio(): string
    {
        return $this->audio;
    }

    public function setAudio(string $audio): self
    {
        $this->audio = $audio;

        return $this;
    }

    public function getVideo(): string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }
}
