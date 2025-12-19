<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\DataType\Text\Url;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\GeoShape;
use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject\ImageObject;

class Place extends Thing
{
    public function address(PostalAddress $postalAddress): static
    {
        $this->setProperty('address', $this->parseChild($postalAddress));

        return $this;
    }

    public function branchCode(string $branchCode): static
    {
        $this->setProperty('branchCode', $branchCode);

        return $this;
    }

    public function containedInPlace(self $place): static
    {
        $this->setProperty('containedInPlace', $this->parseChild($place));

        return $this;
    }

    public function containsPlace(self $place): static
    {
        $this->setProperty('containsPlace', $this->parseChild($place));

        return $this;
    }

    public function event(Event $event): static
    {
        $this->setProperty('event', $this->parseChild($event));

        return $this;
    }

    public function faxNumber(string $faxNumber): static
    {
        $this->setProperty('faxNumber', $faxNumber);

        return $this;
    }

    public function geo(GeoShape $geoShape): static
    {
        $this->setProperty('geo', $this->parseChild($geoShape));

        return $this;
    }

    public function keywords(string $keywords): static
    {
        $this->setProperty('keywords', $keywords);

        return $this;
    }

    public function latitude(float|string $latitude): static
    {
        $this->setProperty('latitude', $latitude);

        return $this;
    }

    public function logo(ImageObject|Url $logo): static
    {
        $this->setProperty('logo', $this->parseChild($logo));

        return $this;
    }

    public function longitude(float|string $longitude): static
    {
        $this->setProperty('longitude', $longitude);

        return $this;
    }

    public function slogan(string $slogan): static
    {
        $this->setProperty('slogan', $slogan);

        return $this;
    }

    public function telephone(string $telephone): static
    {
        $this->setProperty('telephone', $telephone);

        return $this;
    }
}
