<?php

namespace Rami\SeoBundle\Schema\Traits;

use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\Intangible\DefinedTerm;
use Rami\SeoBundle\Schema\Thing\Intangible\Grant;
use Rami\SeoBundle\Utils\Utils;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;
use Rami\SeoBundle\Schema\Thing\Place;

trait OrganizationTrait
{

    /**
     * @param string $duns
     * @return $this
     */
    public function duns(string $duns): static
    {
        $this->setProperty('duns', $duns);
        return $this;
    }

    /**
     * @param string $currenciesAccepted
     * @return $this
     */
    public function currenciesAccepted(string $currenciesAccepted): static
    {
        $this->setProperty('currenciesAccepted', $currenciesAccepted);
        return $this;
    }

    /**
     * @param string $paymentAccepted
     * @return $this
     */
    public function paymentAccepted(string $paymentAccepted): static
    {
        $this->setProperty('paymentAccepted', $paymentAccepted);
        return $this;
    }

    /**
     * @param CreativeWork|string $creativeWork
     * @return $this
     */
    public function actionableFeedbackPolicy(CreativeWork|string $creativeWork): static
    {
        if (is_string($creativeWork)) {
            $this->setProperty('actionableFeedbackPolicy', $creativeWork);
            return $this;
        }

        $this->setProperty('actionableFeedbackPolicy', $this->parseChild($creativeWork));
        return $this;
    }

    /**
     * @param PostalAddress|string $address
     * @return $this
     */
    public function address(PostalAddress|string $address): static
    {
        if (is_string($address)) {
            $this->setProperty('address', $address);
            return $this;
        }

        $this->setProperty('address', $this->parseChild($address));
        return $this;
    }

    /**
     * @param $alumni Person[]
     * @return $this
     */
    public function alumni(array $alumni): static
    {
        $this->setProperty('alumni', $this->parseArray($alumni));
        return $this;
    }

    /**
     * @param array $employee Person[]
     * @return $this
     */
    public function employee(array $employee): static
    {
        $this->setProperty('employee', $this->parseArray($employee));
        return $this;
    }

    /**
     * @param array $member Person[]
     * @return $this
     */
    public function member(array $member): static
    {
        $this->setProperty('member', $this->parseArray($member));
        return $this;
    }

    public function faxNumber(string $faxNumber): static
    {
        $this->setProperty('faxNumber', $faxNumber);
        return $this;
    }

    /**
     * @param array $founder Person[] | Organization[]
     * @return $this
     */
    public function founders(array $founder): static
    {
        $this->setProperty('founder', $this->parseArray($founder));
        return $this;
    }

    /**
     * @param \DateTime $foundingDate
     * @return $this
     * @throws \DateMalformedStringException
     */
    public function foundingDate(\DateTime $foundingDate): static
    {
        $this->setProperty('foundingDate', Utils::parseFullDateIso8601($foundingDate));
        return $this;
    }

    /**
     * @param Place $foundingPlace
     * @return $this
     */
    public function foundingPlace(Place $foundingPlace): static
    {
        $this->setProperty('foundingPlace', $this->parseChild($foundingPlace));
        return $this;
    }

    /**
     * @param \Rami\SeoBundle\Schema\Thing\Organization|\Rami\SeoBundle\Schema\Thing\Person $organization
     * @return $this
     */
    public function funder(Organization|Person $organization): static
    {
        $this->setProperty('funder', $this->parseChild($organization));
        return $this;
    }

    /**
     * @param Grant $grant
     * @return $this
     */
    public function funding(Grant $grant): static
    {
        $this->setProperty('funding', $this->parseChild($grant));
        return $this;
    }

    /**
     * @param string $globalLocationNumber
     * @return $this
     */
    public function globalLocationNumber(string $globalLocationNumber): static
    {
        $this->setProperty('globalLocationNumber', $globalLocationNumber);
        return $this;
    }

    /**
     * @param string $legalName
     * @return $this
     */
    public function legalName(string $legalName): static
    {
        $this->setProperty('legalName', $legalName);
        return $this;
    }

    public function subOrganization(Organization $organization): static
    {
        $this->setProperty('subOrganization', $this->parseChild($organization));
        return $this;
    }

    public function slogan(string|DefinedTerm $slogan): static
    {
        if (is_string($slogan)) {
            $this->setProperty('slogan', $slogan);
            return $this;
        }
        $this->setProperty('slogan', $this->parseChild($slogan));
        return $this;
    }
}