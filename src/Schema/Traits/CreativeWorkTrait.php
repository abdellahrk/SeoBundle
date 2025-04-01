<?php

namespace Rami\SeoBundle\Schema\Traits;

use Rami\SeoBundle\Schema\Thing\Place\AdministrativeArea\Country;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;

trait CreativeWorkTrait
{
    public function abstract(string $abstract): static
    {
        $this->setProperty('abstract', $abstract);
        return $this;
    }

    public function expires(\DateTime $dateTime): static
    {
        $this->setProperty('expires', $dateTime);
        return $this;
    }

    public function accessMode(string $accessMode): static
    {
        $this->setProperty('accessMode', $accessMode);
        return $this;
    }

    public function accessibilityAPI(string $accessibilityAPI): static
    {
        $this->setProperty('accessibilityAPI', $accessibilityAPI);
        return $this;
    }

    public function accessibilityControl(string $accessibilityControl): static
    {
        $this->setProperty('accessibilityControl', $accessibilityControl);
        return $this;
    }

    public function accessibilityFeature(string $accessibilityFeature): static
    {
        $this->setProperty('accessibilityFeature', $accessibilityFeature);
        return $this;
    }

    public function accessibilityHazard(string $accessibilityHazard): static
    {
        $this->setProperty('accessibilityHazard', $accessibilityHazard);
        return $this;
    }

    public function accessibilitySummary(string $accessibilitySummary): static
    {
        $this->setProperty('accessibilitySummary', $accessibilitySummary);
        return $this;
    }

    public function accountablePerson(Person $person): static
    {
        $this->setProperty('accountablePerson', $this->parseChild($person));
        return $this;
    }

    public function author(Person|Organization $author): static
    {
        $this->setProperty('author', $this->parseChild($author));
        return $this;
    }

    public function contributor(Person|Organization $contributor): static
    {
        $this->setProperty('contributor', $this->parseChild($contributor));
        return $this;
    }

    public function creator(Person|Organization $creator): static
    {
        $this->setProperty('creator', $this->parseChild($creator));
        return $this;
    }

    public function copyrightHolder(Person|Organization $copyrightHolder): static
    {
        $this->setProperty('copyrightHolder', $this->parseChild($copyrightHolder));
        return $this;
    }

    public function copyrightNotice(string $copyrightNotice): static
    {
        $this->setProperty('copyrightNotice', $copyrightNotice);
        return $this;
    }

    public function copyrightYear(int $copyrightYear): static
    {
        $this->setProperty('copyrightYear', $copyrightYear);
        return $this;
    }

    public function countryOfOrigin(Country $countryOfOrigin): static
    {
        $this->setProperty('countryOfOrigin', $this->parseChild($countryOfOrigin));
        return $this;
    }

    public function creditText(string $creditText): static
    {
        $this->setProperty('creditText', $creditText);
        return $this;
    }

    public function editor(Person $editor): static
    {
        $this->setProperty('editor', $this->parseChild($editor));
        return $this;
    }

    public function funder(Person|Organization $funder): static
    {
        $this->setProperty('funder', $this->parseChild($funder));
        return $this;
    }

    public function publisher(Person|Organization $publisher): static
    {
        $this->setProperty('publisher', $this->parseChild($publisher));
        return $this;
    }

    public function text(string $text): static
    {
        $this->setProperty('text', $text);
        return $this;
    }

    public function conditionsOfAccess(string $conditions): static
    {
        $this->setProperty('conditionsOfAccess', $conditions);
        return $this;
    }
}