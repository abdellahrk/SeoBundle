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
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;
use Rami\SeoBundle\Schema\Thing\Place\AdministrativeArea\Country;

class PersonTest extends TestCase
{
    private Person $person;

    protected function setUp(): void
    {
        parent::setUp();
        $this->person = new Person();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->person);
    }

    public function testGetTypeReturnsPerson(): void
    {
        $this->assertEquals('Person', $this->person->getType());
    }

    public function testAdditionalNameSetsProperty(): void
    {
        $this->person->additionalName('Middle Name');
        $this->assertEquals('Middle Name', $this->person->getProperty('additionalName'));
    }

    public function testAwardSetsProperty(): void
    {
        $this->person->award('Nobel Prize');
        $this->assertEquals('Nobel Prize', $this->person->getProperty('award'));
    }

    public function testJobTitleSetsProperty(): void
    {
        $this->person->jobTitle('Software Engineer');
        $this->assertEquals('Software Engineer', $this->person->getProperty('jobTitle'));
    }

    public function testBirthDateFormatsCorrectly(): void
    {
        $date = new \DateTime('1990-05-15');
        $this->person->birthDate($date);
        $this->assertEquals('1990-05-15', $this->person->getProperty('birthDate'));
    }

    public function testBirthPlaceSetsProperty(): void
    {
        $this->person->birthPlace('Berlin, Germany');
        $this->assertEquals('Berlin, Germany', $this->person->getProperty('birthPlace'));
    }

    public function testEmailSetsProperty(): void
    {
        $this->person->email('test@example.com');
        $this->assertEquals('test@example.com', $this->person->getProperty('email'));
    }

    public function testFamilyNameSetsProperty(): void
    {
        $this->person->familyName('Doe');
        $this->assertEquals('Doe', $this->person->getProperty('familyName'));
    }

    public function testGivenNameSetsProperty(): void
    {
        $this->person->givenName('John');
        $this->assertEquals('John', $this->person->getProperty('givenName'));
    }

    public function testTelephoneSetsProperty(): void
    {
        $this->person->telephone('+49-123-456789');
        $this->assertEquals('+49-123-456789', $this->person->getProperty('telephone'));
    }

    public function testAddressWithString(): void
    {
        $this->person->address('123 Main St, City');
        $this->assertEquals('123 Main St, City', $this->person->getProperty('address'));
    }

    public function testAddressWithPostalAddress(): void
    {
        $address = new PostalAddress();
        $address->name('Home Address');

        $this->person->address($address);

        $addressProperty = $this->person->getProperty('address');
        $this->assertIsArray($addressProperty);
        $this->assertArrayHasKey('@type', $addressProperty);
        $this->assertEquals('PostalAddress', $addressProperty['@type']);
    }

    public function testRelatedToWithString(): void
    {
        $this->person->relatedTo('Jane Doe');
        $this->assertEquals('Jane Doe', $this->person->getProperty('relatedTo'));
    }

    public function testRelatedToWithPerson(): void
    {
        $relatedPerson = new Person();
        $relatedPerson->name('Jane Doe');

        $this->person->relatedTo($relatedPerson);

        $relatedProperty = $this->person->getProperty('relatedTo');
        $this->assertIsArray($relatedProperty);
        $this->assertArrayHasKey('@type', $relatedProperty);
        $this->assertEquals('Person', $relatedProperty['@type']);
    }

    public function testAlumniOfSetsOrganization(): void
    {
        $university = new Organization();
        $university->name('MIT');

        $this->person->alumniOf($university);

        $alumniProperty = $this->person->getProperty('alumniOf');
        $this->assertIsArray($alumniProperty);
        $this->assertEquals('Organization', $alumniProperty['@type']);
    }

    public function testCallSignSetsProperty(): void
    {
        $this->person->callSign('ABC123');
        $this->assertEquals('ABC123', $this->person->getProperty('callSign'));
    }

    public function testChildrenWithSinglePerson(): void
    {
        $child = new Person();
        $child->name('Child Person');

        $this->person->children($child);

        $childrenProperty = $this->person->getProperty('children');
        $this->assertIsArray($childrenProperty);
        $this->assertEquals('Person', $childrenProperty['@type']);
    }

    public function testChildrenWithArray(): void
    {
        $child1 = new Person();
        $child1->name('Child 1');

        $child2 = new Person();
        $child2->name('Child 2');

        $this->person->children([$child1, $child2]);

        $childrenProperty = $this->person->getProperty('children');
        $this->assertIsArray($childrenProperty);
        $this->assertCount(2, $childrenProperty);
    }

    public function testSpouseSetsPersonProperty(): void
    {
        $spouse = new Person();
        $spouse->name('Spouse Name');

        $this->person->spouse($spouse);

        $spouseProperty = $this->person->getProperty('spouse');
        $this->assertIsArray($spouseProperty);
        $this->assertEquals('Person', $spouseProperty['@type']);
    }

    public function testWorksForSetsOrganization(): void
    {
        $company = new Organization();
        $company->name('Tech Company');

        $this->person->worksFor($company);

        $worksForProperty = $this->person->getProperty('worksFor');
        $this->assertIsArray($worksForProperty);
        $this->assertEquals('Organization', $worksForProperty['@type']);
    }

    public function testNationalitySetsCountry(): void
    {
        $country = new Country();
        $country->name('Germany');

        $this->person->nationality($country);

        $nationalityProperty = $this->person->getProperty('nationality');
        $this->assertIsArray($nationalityProperty);
        $this->assertEquals('Country', $nationalityProperty['@type']);
    }

    public function testFluentInterface(): void
    {
        $result = $this->person
            ->givenName('John')
            ->familyName('Doe')
            ->email('john@example.com')
            ->jobTitle('Developer');

        $this->assertSame($this->person, $result);
    }

    public function testCompletePersonSchema(): void
    {
        $address = new PostalAddress();
        $address->name('Home');

        $company = new Organization();
        $company->name('Tech Corp');

        $birthDate = new \DateTime('1985-06-20');

        $this->person
            ->name('Dr. John Doe')
            ->givenName('John')
            ->familyName('Doe')
            ->additionalName('Michael')
            ->email('john.doe@example.com')
            ->telephone('+1-555-1234')
            ->birthDate($birthDate)
            ->birthPlace('New York')
            ->jobTitle('Senior Software Engineer')
            ->address($address)
            ->worksFor($company);

        $properties = $this->person->getProperties();

        $this->assertEquals('Dr. John Doe', $properties['name']);
        $this->assertEquals('John', $properties['givenName']);
        $this->assertEquals('Doe', $properties['familyName']);
        $this->assertEquals('Michael', $properties['additionalName']);
        $this->assertEquals('john.doe@example.com', $properties['email']);
        $this->assertEquals('1985-06-20', $properties['birthDate']);
    }

    public function testRenderOutputsValidJsonLd(): void
    {
        $this->person
            ->name('John Doe')
            ->email('john@example.com')
            ->jobTitle('Developer');

        $rendered = $this->person->render();

        $this->assertStringContainsString('"@type": "Person"', $rendered);
        $this->assertStringContainsString('John Doe', $rendered);
        $this->assertStringContainsString('john@example.com', $rendered);
        $this->assertStringContainsString('Developer', $rendered);
    }
}
