<?php

namespace Rami\SeoBundle\Schema\Intangible;

use Rami\SeoBundle\Schema\BaseType;

class Service extends BaseType
{
    public array $properties = [];

    public function getType(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    public function areaServed(string $areaServed): static
    {
        $this->setProperty('areaServed', $areaServed);
        return $this;
    }

    public function award(string $award): static
    {
        $this->setProperty('award', $award);
        return $this;
    }

    public function termsOfService(string $termsOfService): static
    {
        $this->setProperty('termsOfService', $termsOfService);
        return $this;
    }

    public function slogan(string $slogan): static
    {
        $this->setProperty('slogan', $slogan);
        return $this;
    }

    public function providerMobility(string $providerMobility): static
    {
        $this->setProperty('providerMobility', $providerMobility);
        return $this;
    }

    public function serviceType(string $serviceType): static
    {
        $this->setProperty('serviceType', $serviceType);
        return $this;
    }
}