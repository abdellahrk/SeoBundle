<?php
/*
 * Copyright (c) 2025.
 *
 * This file is part of the SEO Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\SeoBundle\Test\Integration\Schema;

use PHPUnit\Framework\TestCase;
use Rami\SeoBundle\Schema\Intangible\Offer;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject\ImageObject;
use Rami\SeoBundle\Schema\Thing\Event;
use Rami\SeoBundle\Schema\Thing\Intangible\Audience;
use Rami\SeoBundle\Schema\Thing\Intangible\VirtualLocation;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;
use Rami\SeoBundle\Schema\Thing\Place;

class EventTest extends TestCase
{
    private Event $event;

    protected function setUp(): void
    {
        parent::setUp();
        $this->event = new Event();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->event);
    }

    public function testGetTypeReturnsEvent(): void
    {
        $this->assertEquals('Event', $this->event->getType());
    }

    public function testStartDateFormatsCorrectly(): void
    {
        $date = new \DateTime('2025-06-15 10:00:00');
        $this->event->startDate($date);

        $startDate = $this->event->getProperty('startDate');
        $this->assertIsString($startDate);
        $this->assertStringContainsString('2025-06-15', $startDate);
    }

    public function testStartDateWithTimezone(): void
    {
        $date = new \DateTime('2025-06-15 10:00:00', new \DateTimeZone('UTC'));
        $timezone = new \DateTimeZone('Europe/Berlin');

        $this->event->startDate($date, $timezone);

        $startDate = $this->event->getProperty('startDate');
        $this->assertIsString($startDate);
        $this->assertStringContainsString('2025-06-15', $startDate);
    }

    public function testEndDateFormatsCorrectly(): void
    {
        $date = new \DateTime('2025-06-15 18:00:00');
        $this->event->endDate($date);

        $endDate = $this->event->getProperty('endDate');
        $this->assertIsString($endDate);
        $this->assertStringContainsString('2025-06-15', $endDate);
    }

    public function testEndDateWithTimezone(): void
    {
        $date = new \DateTime('2025-06-15 18:00:00', new \DateTimeZone('UTC'));
        $timezone = new \DateTimeZone('America/New_York');

        $this->event->endDate($date, $timezone);

        $endDate = $this->event->getProperty('endDate');
        $this->assertIsString($endDate);
    }

    public function testFunderWithPerson(): void
    {
        $funder = new Person();
        $funder->name('Funding Person');

        $this->event->funder($funder);

        $funderProperty = $this->event->getProperty('funder');
        $this->assertIsArray($funderProperty);
        $this->assertEquals('Person', $funderProperty['@type']);
    }

    public function testFunderWithOrganization(): void
    {
        $funder = new Organization();
        $funder->name('Funding Organization');

        $this->event->funder($funder);

        $funderProperty = $this->event->getProperty('funder');
        $this->assertIsArray($funderProperty);
        $this->assertEquals('Organization', $funderProperty['@type']);
    }

    public function testOrganizerSetsProperty(): void
    {
        $organizer = new Organization();
        $organizer->name('Event Organizer Inc');

        $this->event->organizer($organizer);

        $organizerProperty = $this->event->getProperty('organizer');
        $this->assertIsArray($organizerProperty);
        $this->assertEquals('Organization', $organizerProperty['@type']);
    }

    public function testPerformerSetsProperty(): void
    {
        $performer = new Person();
        $performer->name('Famous Performer');

        $this->event->performer($performer);

        $performerProperty = $this->event->getProperty('performer');
        $this->assertIsArray($performerProperty);
        $this->assertEquals('Person', $performerProperty['@type']);
    }

    public function testOffersSetsProperty(): void
    {
        $offer = new Offer();
        $offer->name('Early Bird Ticket');

        $this->event->offers($offer);

        $offersProperty = $this->event->getProperty('offers');
        $this->assertIsArray($offersProperty);
        $this->assertEquals('Offer', $offersProperty['@type']);
    }

    public function testLocationWithString(): void
    {
        $this->event->location('Berlin, Germany');

        $location = $this->event->getProperty('location');
        $this->assertEquals('Berlin, Germany', $location);
    }

    public function testLocationWithPlace(): void
    {
        $place = new Place();
        $place->name('Convention Center');

        $this->event->location($place);

        $locationProperty = $this->event->getProperty('location');
        $this->assertIsArray($locationProperty);
        $this->assertEquals('Place', $locationProperty['@type']);
    }

    public function testLocationWithPostalAddress(): void
    {
        $address = new PostalAddress();
        $address->name('Event Venue');

        $this->event->location($address);

        $locationProperty = $this->event->getProperty('location');
        $this->assertIsArray($locationProperty);
        $this->assertEquals('PostalAddress', $locationProperty['@type']);
    }

    public function testLocationWithVirtualLocation(): void
    {
        $virtualLocation = new VirtualLocation();
        $virtualLocation->name('Online Meeting');

        $this->event->location($virtualLocation);

        $locationProperty = $this->event->getProperty('location');
        $this->assertIsArray($locationProperty);
        $this->assertEquals('VirtualLocation', $locationProperty['@type']);
    }

    public function testSponsorSetsProperty(): void
    {
        $sponsor = new Organization();
        $sponsor->name('Sponsor Company');

        $this->event->sponsor($sponsor);

        $sponsorProperty = $this->event->getProperty('sponsor');
        $this->assertIsArray($sponsorProperty);
        $this->assertEquals('Organization', $sponsorProperty['@type']);
    }

    public function testDirectorSetsProperty(): void
    {
        $director = new Person();
        $director->name('Event Director');

        $this->event->director($director);

        $directorProperty = $this->event->getProperty('director');
        $this->assertIsArray($directorProperty);
        $this->assertEquals('Person', $directorProperty['@type']);
    }

    public function testAttendeeSetsProperty(): void
    {
        $attendee = new Person();
        $attendee->name('Attendee Name');

        $this->event->attendee($attendee);

        $attendeeProperty = $this->event->getProperty('attendee');
        $this->assertIsArray($attendeeProperty);
        $this->assertEquals('Person', $attendeeProperty['@type']);
    }

    public function testComposerSetsProperty(): void
    {
        $composer = new Person();
        $composer->name('Music Composer');

        $this->event->composer($composer);

        $composerProperty = $this->event->getProperty('composer');
        $this->assertIsArray($composerProperty);
        $this->assertEquals('Person', $composerProperty['@type']);
    }

    public function testAudienceSetsProperty(): void
    {
        $audience = new Audience();
        $audience->name('General Public');

        $this->event->audience($audience);

        $audienceProperty = $this->event->getProperty('audience');
        $this->assertIsArray($audienceProperty);
        $this->assertEquals('Audience', $audienceProperty['@type']);
    }

    public function testEventAttendanceModeSetsProperty(): void
    {
        $this->event->eventAttendanceMode('https://schema.org/OnlineEventAttendanceMode');
        $this->assertEquals('https://schema.org/OnlineEventAttendanceMode', $this->event->getProperty('eventAttendanceMode'));
    }

    public function testEventStatusSetsProperty(): void
    {
        $this->event->eventStatus('https://schema.org/EventScheduled');
        $this->assertEquals('https://schema.org/EventScheduled', $this->event->getProperty('eventStatus'));
    }

    public function testImageWithString(): void
    {
        $this->event->image('https://example.com/event-image.jpg');
        $this->assertEquals('https://example.com/event-image.jpg', $this->event->getProperty('image'));
    }

    public function testImageWithImageObject(): void
    {
        $imageObject = new ImageObject();
        $imageObject->name('Event Photo');

        $this->event->image($imageObject);

        $imageProperty = $this->event->getProperty('image');
        $this->assertIsArray($imageProperty);
        $this->assertEquals('ImageObject', $imageProperty['@type']);
    }

    public function testFluentInterface(): void
    {
        $result = $this->event
            ->name('Tech Conference')
            ->eventStatus('https://schema.org/EventScheduled')
            ->eventAttendanceMode('https://schema.org/OfflineEventAttendanceMode');

        $this->assertSame($this->event, $result);
    }

    public function testCompleteEventSchema(): void
    {
        $organizer = new Organization();
        $organizer->name('Tech Events Inc');

        $place = new Place();
        $place->name('Convention Center Berlin');

        $offer = new Offer();
        $offer->name('Standard Ticket');

        $startDate = new \DateTime('2025-09-15 09:00:00');
        $endDate = new \DateTime('2025-09-15 18:00:00');

        $this->event
            ->name('Annual Tech Conference 2025')
            ->setDescription('The largest tech conference in Europe')
            ->startDate($startDate)
            ->endDate($endDate)
            ->location($place)
            ->organizer($organizer)
            ->offers($offer)
            ->eventStatus('https://schema.org/EventScheduled')
            ->eventAttendanceMode('https://schema.org/OfflineEventAttendanceMode');

        $properties = $this->event->getProperties();

        $this->assertEquals('Annual Tech Conference 2025', $properties['name']);
        $this->assertEquals('The largest tech conference in Europe', $properties['description']);
        $this->assertArrayHasKey('startDate', $properties);
        $this->assertArrayHasKey('endDate', $properties);
        $this->assertArrayHasKey('location', $properties);
    }

    public function testRenderOutputsValidJsonLd(): void
    {
        $startDate = new \DateTime('2025-10-01 10:00:00');

        $this->event
            ->name('Workshop')
            ->startDate($startDate)
            ->eventStatus('https://schema.org/EventScheduled');

        $rendered = $this->event->render();

        $this->assertStringContainsString('"@type": "Event"', $rendered);
        $this->assertStringContainsString('Workshop', $rendered);
        $this->assertStringContainsString('2025-10-01', $rendered);
    }
}
