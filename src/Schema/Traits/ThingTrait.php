<?php

namespace Rami\SeoBundle\Schema\Traits;

use Rami\SeoBundle\Schema\Intangible\Service;
use Rami\SeoBundle\Schema\Thing\Action;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\CreativeWork\ImageObject;
use Rami\SeoBundle\Schema\Thing\CreativeWork\TextObject;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\PropertyValue;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;

trait ThingTrait
{
    public function additionalType(string $additionalType): static
    {
        $this->setProperty('additionalType', $additionalType);
        return $this;
    }

    public function alternateName(string $alternateName): static
    {
        $this->setProperty('alternateName', $alternateName);
        return $this;
    }

    public function description(string|TextObject $description): static
    {
        if ($description instanceof TextObject) {
            $this->setProperty('description', $this->parseChild($description));
        } else {
            $this->setProperty('description', $description);
        }
        return $this;
    }

    public function disambiguatingDescription(string $description): static
    {
        $this->setProperty('disambiguatingDescription', $description);
        return $this;
    }

    public function identifier(PropertyValue|string $identifier): static
    {
        if ($identifier instanceof PropertyValue) {
            $this->setProperty('identifier', $this->parseChild($identifier));
        } else {
            $this->setProperty('identifier', $identifier);
        }
        return $this;
    }

    public function image(ImageObject|string $image): static
    {
        if ($image instanceof ImageObject) {
            $this->setProperty('image', $this->parseChild($image));
        } else {
            $this->setProperty('image', $image);
        }
        return $this;
    }

    public function mainEntityOfPage(CreativeWork|string $mainEntityOfPage): static
    {
        if ($mainEntityOfPage instanceof CreativeWork) {
            $this->setProperty('mainEntityOfPage', $this->parseChild($mainEntityOfPage));
        } else {
            $this->setProperty('mainEntityOfPage', $mainEntityOfPage);
        }
        return $this;
    }

    public function name(string $name): static
    {
        $this->setProperty('name', $name);
        return $this;
    }

    public function owner(Organization|Person $owner): static
    {
        $this->setProperty('owner', $this->parseChild($owner));
        return $this;
    }

    public function potentialAction(Action $action): static
    {
        $this->setProperty('potentialAction', $this->parseChild($action));
        return $this;
    }

    public function sameAs(string $sameAs): static
    {
        $this->setProperty('sameAs', $sameAs);
        return $this;
    }

    public function serviceOutput(Service $service): Service
    {
        $this->setProperty('serviceOutput', $this->parseChild($service));
        return $service;
    }
}