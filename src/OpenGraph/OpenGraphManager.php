<?php

namespace Rami\SeoBundle\OpenGraph;

use Rami\SeoBundle\OpenGraph\Model\OpenGraph;
use Symfony\Component\Cache\ResettableInterface;

class OpenGraphManager implements OpenGraphManagerInterface, ResettableInterface
{
    public OpenGraph $openGraph;
    public function __construct() {
        $this->openGraph = new OpenGraph();
    }

    public function getOpenGraph(): OpenGraph
    {
        return $this->openGraph;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->openGraph->getLocale();
    }

    /*
     * @param string $locale The locale these tags are marked up in. Of the format language_TERRITORY. Default is en_US
     * @return self
     */
    public function setLocale(string $locale): static
    {
        $this->openGraph->setLocale($locale);
        return $this;
    }

    public function getAlternateLocale(): string
    {
        return $this->openGraph->getAlternateLocale();
    }

    /**
     * @param string $alternateLocale An array of other locales this page is available in.
     * @return $this
     */
    public function setAlternateLocale(string $alternateLocale): static
    {
        $this->openGraph->setAlternateLocale($alternateLocale);
        return $this;
    }

    public function getSiteName(): string
    {
        return $this->openGraph->getSiteName();
    }

    /**
     * @param string $siteName If your object is part of a larger web site, the name which should be displayed for the overall site.
     * @return $this
     */
    public function setSiteName(string $siteName): static
    {
        $this->openGraph->setSiteName($siteName);
        return $this;
    }

    /**
     * @param string $title The title of your object as it should appear within the graph, e.g., "The Open Graph".
     * @return $this
     */
    public function setTitle(string $title): static
    {
        $this->openGraph->setTitle($title);
        return $this;
    }

    public function getTitle(): string
    {
        return $this->openGraph->getTitle();
    }

    public function getDescription(): string
    {
        return $this->openGraph->getDescription();
    }

    /**
     * @param string $description A one to two sentence description of your object.
     * @return $this
     */
    public function setDescription(string $description): static
    {
        $this->openGraph->setDescription($description);
        return $this;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setImage(string $image): static
    {
        $this->openGraph->setImageUrl($image);
        return $this;
    }

    public function getImage(): string
    {
        return $this->openGraph->getImageUrl();
    }

    public function getUrl(): string
    {
        return $this->openGraph->getUrl();
    }

    /**
     * @param string $url The canonical URL of your object that will be used as its permanent ID in the graph, e.g., "https://www.imdb.com/title/tt0117500/"
     * @return $this
     */
    public function setUrl(string $url): static
    {
        $this->openGraph->setUrl($url);
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->openGraph->getType();
    }

    /**
     * @param string $type The type of your object, e.g., "video.movie". Depending on the type you specify, other properties may also be required.
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->openGraph->setType($type);
        return $this;
    }

    public function getStructuredProperties(): array
    {
        return $this->openGraph->getStructuredProperties();
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

        $structuredProperty['type'] = $type;
        $structuredProperty['property'] = $property;
        $structuredProperty['content'] = $content ;

//        if (!isset($structuredProperty[$type])) {
//            $structuredProperty[$type] = [];
//        }

        $structuredProperty['property'][] = $structuredProperty;
        $this->openGraph->setStructuredProperties($structuredProperty);
        return $this;
    }

    /**
     * @param string $property
     * @param string $content
     * @return $this
     */
    public function addMusicProperty(string $property, string $content): static
    {
        $this->openGraph->setMusicProperties(['property' => $property, 'content' => $content]);
        return $this;
    }

    public function getMusicProperties(): array
    {
        return $this->openGraph->getMusicProperties();
    }

    /**
     * @param string $name The name of the property E.g description and <meta name=twitter:description" content=".."/>
     * @param string $content The content of the property name
     * @return $this
     */
    public function addTwitterCardProperty(string $name, string $content): static
    {
        $this->openGraph->setTwitterCardProperties([$name => $content]);
        return $this;
    }

    /**
     * @return array
     */
    public function getTwitterCardProperties(): array
    {
        return $this->openGraph->getTwitterCardProperties();
    }

    public function reset(): void
    {
        $this->openGraph = new OpenGraph();
    }

    /**
     * @return string
     */
    public function getAudio(): string
    {
        return $this->openGraph->getAudio();
    }

    /**
     * @param string $audio
     * @return $this
     */
    public function setAudio(string $audio): static
    {
        $this->openGraph->setAudio($audio);
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo(): string
    {
        return $this->openGraph->getVideo();
    }

    /**
     * @param string $video
     * @return $this
     */
    public function setVideo(string $video): static
    {
        $this->openGraph->setVideo($video);
        return $this;
    }

    /**
     * @return string
     */
    public function getImageAltText(): string
    {
        return $this->openGraph->getImageAlt();
    }

    /**
     * @param string $imageAltText
     * @return $this
     */
    public function setImageAltText(string $imageAltText): static
    {
        $this->openGraph->setImageAlt($imageAltText);
        return $this;
    }
}