<?php

namespace Rami\SeoBundle\OpenGraph;

use Symfony\Component\Cache\ResettableInterface;

class OpenGraph implements OpenGraphInterface, ResettableInterface
{
    private string $title='';
    private string $description='';
    private string $imageUrl='';
    private string $url='';
    private string $type='';
    private string $locale = '';

    private string $alternateLocale = '';
    private string $siteName='';

    private array $structuredProperty = [
        'type' => null,
        'property' => null,
        'content' => null,
    ];

    private array $structuredProperties = [];

    private array $musicProperties = [];

    private array $twitterCardProperties = [];


    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /*
     * @param string $locale The locale these tags are marked up in. Of the format language_TERRITORY. Default is en_US
     * @return self
     */
    public function setLocale(string $locale): static
    {
        $this->locale = $locale;
        return $this;
    }

    public function getAlternateLocale(): string
    {
        return $this->alternateLocale;
    }

    /**
     * @param string $alternateLocale An array of other locales this page is available in.
     * @return $this
     */
    public function setAlternateLocale(string $alternateLocale): static
    {
        $this->alternateLocale = $alternateLocale;
        return $this;
    }

    public function getSiteName(): string
    {
        return $this->siteName;
    }

    /**
     * @param string $siteName If your object is part of a larger web site, the name which should be displayed for the overall site.
     * @return $this
     */
    public function setSiteName(string $siteName): static
    {
        $this->siteName = $siteName;
        return $this;
    }

    /**
     * @param string $title The title of your object as it should appear within the graph, e.g., "The Open Graph".
     * @return $this
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description A one to two sentence description of your object.
     * @return $this
     */
    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setImage(string $image): static
    {
        $this->imageUrl = $image;
        return $this;
    }

    public function getImage(): string
    {
        return $this->imageUrl;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url The canonical URL of your object that will be used as its permanent ID in the graph, e.g., "https://www.imdb.com/title/tt0117500/"
     * @return $this
     */
    public function setUrl(string $url): static
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
     * @param string $type The type of your object, e.g., "video.movie". Depending on the type you specify, other properties may also be required.
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getStructuredProperties(): array
    {
        return $this->structuredProperties;
    }

    /**
     * @param string $type
     * @param string $property
     * @param string $content
     * @return $this
     */
    public function addStructuredProperty(string $type, string $property, string $content): static
    {
        if (!in_array($type, ['video', 'audio', 'image'])) {
            return $this;
        }

        $this->structuredProperty['type'] = $type;
        $this->structuredProperty['property'] = $property;
        $this->structuredProperty['content'] = $content ;

        if (!isset($this->structuredProperty[$type])) {
            $this->structuredProperty[$type] = [];
        }

        $this->structuredProperties['property'][] = $this->structuredProperty;
        return $this;
    }

    /**
     * @param string $property
     * @param string $content
     * @return $this
     */
    public function addMusicProperty(string $property, string $content): static
    {
        $this->musicProperties[] = ['property' => $property, 'content' => $content];
        return $this;
    }

    public function getMusicProperties(): array
    {
        return $this->musicProperties;
    }

    /**
     * @param string $name The name of the property E.g description and <meta name=twitter:description" content=".."/>
     * @param string $content The content of the property name
     * @return $this
     */
    public function addTwitterCardProperty(string $name, string $content): static
    {
        $this->twitterCardProperties[$name] = $content;
        return $this;
    }

    /**
     * @return array
     */
    public function getTwitterCardProperties(): array
    {
        return $this->twitterCardProperties;
    }

    public function reset(): void
    {
        $this->title = '';
        $this->description = '';
        $this->imageUrl = '';
        $this->url = '';
        $this->type = '';
        $this->alternateLocale = '';
        $this->siteName = '';
        $this->structuredProperty = [];
        $this->structuredProperties = [];
        $this->musicProperties = [];
        $this->twitterCardProperties = [];
    }
}