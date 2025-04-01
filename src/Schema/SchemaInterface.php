<?php

namespace Rami\SeoBundle\Schema;

use Rami\SeoBundle\Schema\Intangible\Audience;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Intangible\Service;
use Rami\SeoBundle\Schema\Place\AdministrativeArea;
use Rami\SeoBundle\Schema\Thing\Event;
use Rami\SeoBundle\Schema\Thing\Person;

interface SchemaInterface
{
    public function render(BaseType $type): void;
    public function thing(): Thing;
    public function service(): Service;

    public function creativeWork(): CreativeWork;

    public function event(): Event;

    public function person(): Person;
    public function administrativeArea(): AdministrativeArea;
    public function postalAddress(): PostalAddress;
    public function audience(): Audience;

    public function getType(): BaseType|null;

//    private function setType(BaseType $type): void;

}