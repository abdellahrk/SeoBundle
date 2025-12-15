<?php

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\DataType\Text\Url;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\GeoShape;
use Rami\SeoBundle\Schema\Thing;

class Place extends Thing
{
    public function address(PostalAddress $address): static
    {
        $this->setProperty('address', $this->parseChild($address));
        return $this;
    }

    public function branchCode(string $branchCode): static
    {
        $this->setProperty('branchCode', $branchCode);
        return $this;
    }

    public function containedInPlace(Place $place): static
    {
        $this->setProperty('containedInPlace', $this->parseChild($place));
        return $this;
    }

    public function containsPlace(Place $place): static
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

    public function geo(GeoShape $geo): static
    {
        $this->setProperty('geo', $this->parseChild($geo));
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

    public function logo(Thing\CreativeWork\MediaObject\ImageObject|Url $logo): static
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