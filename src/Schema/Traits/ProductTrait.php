<?php

namespace Rami\SeoBundle\Schema\Traits;

use Rami\SeoBundle\Schema\Thing\Intangible\Brand;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Place\AdministrativeArea\Country;

trait ProductTrait
{
    public function sku(string $sku): static
    {
        $this->setProperty('sku', $sku);
        return $this;
    }

    public function colour(string $colour): static
    {
        $this->setProperty('color', $colour);
        return $this;
    }

    public function brand(Organization|Brand $brand): static
    {
        $this->setProperty('brand', $this->parseChild($brand));
        return $this;
    }

    public function countryOfOrigin(Country $countryOfOrigin): static
    {
        $this->setProperty('countryOfOrigin', $this->parseChild($countryOfOrigin));
        return $this;
    }

    public function countryOfLastProcessing(string $countryOfProcessing): static
    {
        $this->setProperty('countryOfProcessing', $countryOfProcessing);
        return $this;
    }

    public function countryOfAssemble(string $countryOfAssemble): static
    {
        $this->setProperty('countryOfAssemble', $countryOfAssemble);
        return $this;
    }

    public function manufacturer(Organization $manufacturer): static
    {
        $this->setProperty('manufacturer', $this->parseChild($manufacturer));
        return $this;
    }

    public function slogan(string $slogan): static
    {
        $this->setProperty('sku', $slogan);
        return $this;
    }

    public function nsn(string $nsn): static
    {
        $this->setProperty('nsn', $nsn);
        return $this;
    }

    public function mpn(string $mpn): static
    {
        $this->setProperty('mpn', $mpn);
        return $this;
    }

    public function mobileUrl(string $mobileUrl): static
    {
        $this->setProperty('mobileUrl', $mobileUrl);
        return $this;
    }
}