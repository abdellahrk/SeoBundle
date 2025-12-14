<?php

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Thing\Intangible\Audience;
use Rami\SeoBundle\Schema\Thing\Intangible\VirtualLocation;

class Event extends BaseType
{
    public array $properties = [];

    public function startDate(\DateTime $startDate): static
    {
        $this->setProperty('startDate', $startDate->format('Y-m-d H:i:s'));
        return $this;
    }

    public function endDate(\DateTime $endDate): static
    {
        $this->setProperty('endDate', $endDate->format('Y-m-d H:i:s'));
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

    public function location(Place|PostalAddress|VirtualLocation|string $location): static
    {
        if (is_string($location)) {
            $this->setProperty('location', $location);
        }

        $this->setProperty('location', $this->parseChild($location));

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

    public function image(string $image):static
    {
        $this->setProperty('image', $image);
        return $this;
    }
}