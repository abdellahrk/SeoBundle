<?php

namespace Abdellahramadan\SeoBundle\Schema;

use Abdellahramadan\SeoBundle\Schema\Intangible\Audience;
use Abdellahramadan\SeoBundle\Schema\Intangible\Service;
use Abdellahramadan\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Abdellahramadan\SeoBundle\Schema\Place\AdministrativeArea;
use Abdellahramadan\SeoBundle\Schema\Thing\CreativeWork;
use Abdellahramadan\SeoBundle\Schema\Thing\Event;
use Abdellahramadan\SeoBundle\Schema\Thing\Person;

interface SchemaInterface
{
    public function setBaseType(BaseType $type): void;
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