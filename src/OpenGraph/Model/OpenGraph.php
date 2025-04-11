<?php
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
    protected string $title='';

    protected string $description='';

    protected string $imageUrl = '';

    protected string $imageAlt = '';

    protected string $url='';

    protected string $type='';

    protected string $locale = '';

    protected string $alternateLocale = '';

    protected string $siteName='';

    protected string $audio = '';

    protected string $video = '';
    protected array $structuredProperty = [
        'type' => null,
        'property' => null,
        'content' => null,
    ];

    protected array $structuredProperties = [];

    protected array $musicProperties = [];

    protected array $twitterCardProperties = [];

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return OpenGraph
     */
    public function setTitle(string $title): OpenGraph
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return OpenGraph
     */
    public function setDescription(string $description): OpenGraph
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return OpenGraph
     */
    public function setImageUrl(string $imageUrl): OpenGraph
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return OpenGraph
     */
    public function setUrl(string $url): OpenGraph
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return OpenGraph
     */
    public function setType(string $type): OpenGraph
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return OpenGraph
     */
    public function setLocale(string $locale): OpenGraph
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlternateLocale(): string
    {
        return $this->alternateLocale;
    }

    /**
     * @param string $alternateLocale
     * @return OpenGraph
     */
    public function setAlternateLocale(string $alternateLocale): OpenGraph
    {
        $this->alternateLocale = $alternateLocale;
        return $this;
    }

    /**
     * @return string
     */
    public function getSiteName(): string
    {
        return $this->siteName;
    }

    /**
     * @param string $siteName
     * @return OpenGraph
     */
    public function setSiteName(string $siteName): OpenGraph
    {
        $this->siteName = $siteName;
        return $this;
    }

    /**
     * @return array
     */
    public function getStructuredProperty(): array
    {
        return $this->structuredProperty;
    }

    /**
     * @param array $structuredProperty
     * @return OpenGraph
     */
    public function setStructuredProperty(array $structuredProperty): OpenGraph
    {
        $this->structuredProperty = $structuredProperty;
        return $this;
    }

    /**
     * @return array
     */
    public function getStructuredProperties(): array
    {
        return $this->structuredProperties;
    }

    /**
     * @param array $structuredProperties
     * @return OpenGraph
     */
    public function setStructuredProperties(array $structuredProperties): OpenGraph
    {
        $this->structuredProperties = $structuredProperties;
        return $this;
    }

    /**
     * @return array
     */
    public function getMusicProperties(): array
    {
        return $this->musicProperties;
    }

    /**
     * @param array $musicProperties
     * @return OpenGraph
     */
    public function setMusicProperties(array $musicProperties): OpenGraph
    {
        $this->musicProperties = $musicProperties;
        return $this;
    }

    /**
     * @return array
     */
    public function getTwitterCardProperties(): array
    {
        return $this->twitterCardProperties;
    }

    /**
     * @param array $twitterCardProperties
     * @return OpenGraph
     */
    public function setTwitterCardProperties(array $twitterCardProperties): OpenGraph
    {
        $this->twitterCardProperties = $twitterCardProperties;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageAlt(): string
    {
        return $this->imageAlt;
    }

    /**
     * @param string $imageAlt
     * @return OpenGraph
     */
    public function setImageAlt(string $imageAlt): OpenGraph
    {
        $this->imageAlt = $imageAlt;
        return $this;
    }

    /**
     * @return string
     */
    public function getAudio(): string
    {
        return $this->audio;
    }

    /**
     * @param string $audio
     * @return OpenGraph
     */
    public function setAudio(string $audio): OpenGraph
    {
        $this->audio = $audio;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo(): string
    {
        return $this->video;
    }

    /**
     * @param string $video
     * @return OpenGraph
     */
    public function setVideo(string $video): OpenGraph
    {
        $this->video = $video;
        return $this;
    }
}