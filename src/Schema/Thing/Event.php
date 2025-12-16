<?php

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\Intangible\Offer;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Thing\Intangible\Audience;
use Rami\SeoBundle\Schema\Thing\Intangible\VirtualLocation;

class Event extends Thing
{
    public array $properties = [];

    public function startDate(\DateTime $startDate, \DateTimeZone $dateTimeZone = null): static
    {
        if ($dateTimeZone instanceof \DateTimeZone) {
            $startDate->setTimezone($dateTimeZone);
        }

        $this->setProperty('startDate', $startDate->format(DATE_ATOM));
        return $this;
    }

    public function endDate(\DateTime $endDate, \DateTimeZone $dateTimeZone = null): static
    {
        if ($dateTimeZone instanceof \DateTimeZone) {
            $endDate->setTimezone($dateTimeZone);
        }

        $this->setProperty('endDate', $endDate->format(DATE_ATOM));
        return $this;
    }

    public function funder(Person|Organization $funder): static
    {
        $this->setProperty('funder', $this->parseChild($funder));
        return $this;
    }

    public function organizer(Person|Organization $organizer): static
    {
        $this->setProperty('organizer', $this->parseChild($organizer));
        return $this;
    }

    public function performer(Person|Organization $performer): static
    {
        $this->setProperty('performer', $this->parseChild($performer));
        return $this;
    }

    public function offers(Offer $offer): static
    {
        $this->setProperty('offers', $this->parseChild($offer));
        return $this;
    }

    public function location(Place|PostalAddress|VirtualLocation|string $location): static
    {
        $this->setProperty('location', is_string($location) ? $location : $this->parseChild($location));

        return $this;
    }

    public function sponsor(Person|Organization $sponsor): static
    {
        $this->setProperty('sponsor', $this->parseChild($sponsor));
        return $this;
    }

    public function director(Person $director): static
    {
        $this->setProperty('director', $this->parseChild($director));
        return $this;
    }

    public function attendee(Person|Organization $attendee): static
    {
        $this->setProperty('attendee', $this->parseChild($attendee));
        return $this;
    }

    public function composer(Person $composer): static
    {
        $this->setProperty('composer', $this->parseChild($composer));
        return $this;
    }

    public function audience(Audience $audience):static
    {
        $this->setProperty('audience', $this->parseChild($audience));
        return $this;
    }

    public function eventAttendanceMode(string $eventAttendanceMode):static
    {
        $this->setProperty('eventAttendanceMode', $eventAttendanceMode);
        return $this;
    }

    public function eventStatus(string $eventStatus):static
    {
        $this->setProperty('eventStatus', $eventStatus);
        return $this;
    }

    public function image(string|Thing\CreativeWork\MediaObject\ImageObject $image):static
    {
        if ($image instanceof Thing\CreativeWork\MediaObject\ImageObject) {
            $this->setProperty('image', $this->parseChild($image));
            return $this;
        }

        $this->setProperty('image', $image);
        return $this;
    }
}