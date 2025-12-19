<?php

declare(strict_types=1);

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

use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;
use Rami\SeoBundle\Schema\Thing\Place\AdministrativeArea\Country;

final class CreativeWorkTest extends TestCase
{
    private CreativeWork $creativeWork;

    protected function setUp(): void
    {
        parent::setUp();
        $this->creativeWork = new CreativeWork();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->creativeWork);
    }

    public function testGetTypeReturnsCreativeWork(): void
    {
        $this->assertSame('CreativeWork', $this->creativeWork->getType());
    }

    public function testAbstractSetsProperty(): void
    {
        $this->creativeWork->abstract('This is an abstract');
        $this->assertEquals('This is an abstract', $this->creativeWork->getProperty('abstract'));
    }

    public function testAccessModeSetsProperty(): void
    {
        $this->creativeWork->accessMode('textual');
        $this->assertEquals('textual', $this->creativeWork->getProperty('accessMode'));
    }

    public function testAccessibilityAPISetsProperty(): void
    {
        $this->creativeWork->accessibilityAPI('ARIA');
        $this->assertEquals('ARIA', $this->creativeWork->getProperty('accessibilityAPI'));
    }

    public function testAccessibilityControlSetsProperty(): void
    {
        $this->creativeWork->accessibilityControl('fullKeyboardControl');
        $this->assertEquals('fullKeyboardControl', $this->creativeWork->getProperty('accessibilityControl'));
    }

    public function testAccessibilityFeatureSetsProperty(): void
    {
        $this->creativeWork->accessibilityFeature('captions');
        $this->assertEquals('captions', $this->creativeWork->getProperty('accessibilityFeature'));
    }

    public function testAccessibilityHazardSetsProperty(): void
    {
        $this->creativeWork->accessibilityHazard('noFlashingHazard');
        $this->assertEquals('noFlashingHazard', $this->creativeWork->getProperty('accessibilityHazard'));
    }

    public function testAccessibilitySummarySetsProperty(): void
    {
        $this->creativeWork->accessibilitySummary('Fully accessible content');
        $this->assertEquals('Fully accessible content', $this->creativeWork->getProperty('accessibilitySummary'));
    }

    public function testAccountablePersonSetsProperty(): void
    {
        $person = new Person();
        $person->name('Accountable Person');

        $this->creativeWork->accountablePerson($person);

        $personProperty = $this->creativeWork->getProperty('accountablePerson');
        $this->assertIsArray($personProperty);
        $this->assertEquals('Person', $personProperty['@type']);
    }

    public function testAcquireLicensePageWithString(): void
    {
        $this->creativeWork->acquireLicensePage('https://example.com/license');
        $this->assertEquals('https://example.com/license', $this->creativeWork->getProperty('acquireLicensePage'));
    }

    public function testAlternativeHeadlineSetsProperty(): void
    {
        $this->creativeWork->alternativeHeadline('Alternative Headline Text');
        $this->assertEquals('Alternative Headline Text', $this->creativeWork->getProperty('alternativeHeadline'));
    }

    public function testAuthorWithPerson(): void
    {
        $person = new Person();
        $person->name('John Author');

        $this->creativeWork->author($person);

        $authorProperty = $this->creativeWork->getProperty('author');
        $this->assertIsArray($authorProperty);
        $this->assertEquals('Person', $authorProperty['@type']);
    }

    public function testAuthorWithOrganization(): void
    {
        $organization = new Organization();
        $organization->name('Publishing House');

        $this->creativeWork->author($organization);

        $authorProperty = $this->creativeWork->getProperty('author');
        $this->assertIsArray($authorProperty);
        $this->assertEquals('Organization', $authorProperty['@type']);
    }

    public function testAwardSetsProperty(): void
    {
        $this->creativeWork->award('Best Content Award 2025');
        $this->assertEquals('Best Content Award 2025', $this->creativeWork->getProperty('award'));
    }

    public function testCharacterSetsProperty(): void
    {
        $person = new Person();
        $person->name('Main Character');

        $this->creativeWork->character($person);

        $characterProperty = $this->creativeWork->getProperty('character');
        $this->assertIsArray($characterProperty);
        $this->assertEquals('Person', $characterProperty['@type']);
    }

    public function testCitationWithString(): void
    {
        $this->creativeWork->citation('Citation text');
        $this->assertEquals('Citation text', $this->creativeWork->getProperty('citation'));
    }

    public function testContributorSetsProperty(): void
    {
        $person = new Person();
        $person->name('Contributor Name');

        $this->creativeWork->contributor($person);

        $contributorProperty = $this->creativeWork->getProperty('contributor');
        $this->assertIsArray($contributorProperty);
        $this->assertEquals('Person', $contributorProperty['@type']);
    }

    public function testCreatorSetsProperty(): void
    {
        $person = new Person();
        $person->name('Content Creator');

        $this->creativeWork->creator($person);

        $creatorProperty = $this->creativeWork->getProperty('creator');
        $this->assertIsArray($creatorProperty);
        $this->assertEquals('Person', $creatorProperty['@type']);
    }

    public function testCountryOfOriginSetsProperty(): void
    {
        $country = new Country();
        $country->name('Germany');

        $this->creativeWork->countryOfOrigin($country);

        $countryProperty = $this->creativeWork->getProperty('countryOfOrigin');
        $this->assertIsArray($countryProperty);
        $this->assertEquals('Country', $countryProperty['@type']);
    }

    public function testCopyrightHolderSetsProperty(): void
    {
        $organization = new Organization();
        $organization->name('Copyright Holder Inc');

        $this->creativeWork->copyrightHolder($organization);

        $holderProperty = $this->creativeWork->getProperty('copyrightHolder');
        $this->assertIsArray($holderProperty);
        $this->assertEquals('Organization', $holderProperty['@type']);
    }

    public function testCopyrightNoticeSetsProperty(): void
    {
        $this->creativeWork->copyrightNotice('© 2025 Example Corp');
        $this->assertEquals('© 2025 Example Corp', $this->creativeWork->getProperty('copyrightNotice'));
    }

    public function testCopyrightYearSetsProperty(): void
    {
        $this->creativeWork->copyrightYear(2025);
        $this->assertEquals(2025, $this->creativeWork->getProperty('copyrightYear'));
    }

    public function testHeadlineSetsProperty(): void
    {
        $this->creativeWork->headline('Main Headline');
        $this->assertEquals('Main Headline', $this->creativeWork->getProperty('headline'));
    }

    public function testKeywordsSetsProperty(): void
    {
        $this->creativeWork->keywords('keyword1, keyword2, keyword3');
        $this->assertEquals('keyword1, keyword2, keyword3', $this->creativeWork->getProperty('keywords'));
    }

    public function testMaintainerSetsProperty(): void
    {
        $person = new Person();
        $person->name('Content Maintainer');

        $this->creativeWork->maintainer($person);

        $maintainerProperty = $this->creativeWork->getProperty('maintainer');
        $this->assertIsArray($maintainerProperty);
        $this->assertEquals('Person', $maintainerProperty['@type']);
    }

    public function testIsFamilyFriendlySetsProperty(): void
    {
        $this->creativeWork->isFamilyFriendly(true);
        $this->assertTrue($this->creativeWork->getProperty('isFamilyFriendly'));

        $this->creativeWork->isFamilyFriendly(false);
        $this->assertFalse($this->creativeWork->getProperty('isFamilyFriendly'));
    }

    public function testCreditTextSetsProperty(): void
    {
        $this->creativeWork->creditText('Photo by John Doe');
        $this->assertEquals('Photo by John Doe', $this->creativeWork->getProperty('creditText'));
    }

    public function testEditorSetsProperty(): void
    {
        $person = new Person();
        $person->name('Editor Name');

        $this->creativeWork->editor($person);

        $editorProperty = $this->creativeWork->getProperty('editor');
        $this->assertIsArray($editorProperty);
        $this->assertEquals('Person', $editorProperty['@type']);
    }

    public function testFunderSetsProperty(): void
    {
        $organization = new Organization();
        $organization->name('Research Foundation');

        $this->creativeWork->funder($organization);

        $funderProperty = $this->creativeWork->getProperty('funder');
        $this->assertIsArray($funderProperty);
        $this->assertEquals('Organization', $funderProperty['@type']);
    }

    public function testPublisherSetsProperty(): void
    {
        $organization = new Organization();
        $organization->name('Publishing Company');

        $this->creativeWork->publisher($organization);

        $publisherProperty = $this->creativeWork->getProperty('publisher');
        $this->assertIsArray($publisherProperty);
        $this->assertEquals('Organization', $publisherProperty['@type']);
    }

    public function testSponsorSetsProperty(): void
    {
        $organization = new Organization();
        $organization->name('Sponsor Corp');

        $this->creativeWork->sponsor($organization);

        $sponsorProperty = $this->creativeWork->getProperty('sponsor');
        $this->assertIsArray($sponsorProperty);
        $this->assertEquals('Organization', $sponsorProperty['@type']);
    }

    public function testTextSetsProperty(): void
    {
        $this->creativeWork->text('Main text content');
        $this->assertEquals('Main text content', $this->creativeWork->getProperty('text'));
    }

    public function testConditionsOfAccessSetsProperty(): void
    {
        $this->creativeWork->conditionsOfAccess('Open access');
        $this->assertEquals('Open access', $this->creativeWork->getProperty('conditionsOfAccess'));
    }

    public function testVersionSetsProperty(): void
    {
        $this->creativeWork->version('2.0');
        $this->assertEquals('2.0', $this->creativeWork->getProperty('version'));
    }

    public function testDateCreatedFormatsCorrectly(): void
    {
        $date = new DateTime('2025-01-15 10:00:00');
        $this->creativeWork->dateCreated($date);

        $dateCreated = $this->creativeWork->getProperty('dateCreated');
        $this->assertIsString($dateCreated);
        $this->assertStringContainsString('2025-01-15', $dateCreated);
    }

    public function testDateCreatedWithTimezone(): void
    {
        $date = new DateTime('2025-01-15 10:00:00', new DateTimeZone('UTC'));
        $dateTimeZone = new DateTimeZone('Europe/Berlin');

        $this->creativeWork->dateCreated($date, $dateTimeZone);

        $dateCreated = $this->creativeWork->getProperty('dateCreated');
        $this->assertIsString($dateCreated);
    }

    public function testDateModifiedFormatsCorrectly(): void
    {
        $date = new DateTime('2025-02-20 14:30:00');
        $this->creativeWork->dateModified($date);

        $dateModified = $this->creativeWork->getProperty('dateModified');
        $this->assertIsString($dateModified);
        $this->assertStringContainsString('2025-02-20', $dateModified);
    }

    public function testDatePublishedFormatsCorrectly(): void
    {
        $date = new DateTime('2025-03-10 09:00:00');
        $this->creativeWork->datePublished($date);

        $datePublished = $this->creativeWork->getProperty('datePublished');
        $this->assertIsString($datePublished);
        $this->assertStringContainsString('2025-03-10', $datePublished);
    }

    public function testFluentInterface(): void
    {
        $creativeWork = $this->creativeWork
            ->headline('Test Headline')
            ->abstract('Test Abstract')
            ->keywords('test, keywords')
            ->isFamilyFriendly(true);

        $this->assertSame($this->creativeWork, $creativeWork);
    }

    public function testCompleteCreativeWorkSchema(): void
    {
        $person = new Person();
        $person->name('Jane Author');

        $organization = new Organization();
        $organization->name('Publishing House Ltd');

        $datePublished = new DateTime('2025-06-01');

        $this->creativeWork
            ->name('Complete Creative Work')
            ->headline('Main Headline')
            ->abstract('This is the abstract')
            ->author($person)
            ->publisher($organization)
            ->datePublished($datePublished)
            ->copyrightYear(2025)
            ->copyrightNotice('© 2025 Publishing House')
            ->keywords('creative, work, schema')
            ->isFamilyFriendly(true);

        $properties = $this->creativeWork->getProperties();

        $this->assertEquals('Complete Creative Work', $properties['name']);
        $this->assertEquals('Main Headline', $properties['headline']);
        $this->assertEquals('This is the abstract', $properties['abstract']);
        $this->assertEquals(2025, $properties['copyrightYear']);
        $this->assertTrue($properties['isFamilyFriendly']);
    }

    public function testRenderOutputsValidJsonLd(): void
    {
        $person = new Person();
        $person->name('Test Author');

        $this->creativeWork
            ->name('Test Creative Work')
            ->headline('Test Headline')
            ->author($person);

        $rendered = $this->creativeWork->render();

        $this->assertStringContainsString('"@type": "CreativeWork"', (string) $rendered);
        $this->assertStringContainsString('Test Creative Work', (string) $rendered);
        $this->assertStringContainsString('Test Headline', (string) $rendered);
    }
}
