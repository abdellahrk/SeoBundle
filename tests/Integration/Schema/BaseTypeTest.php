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

use PHPUnit\Framework\TestCase;
use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Thing\Person;

final class BaseTypeTest extends TestCase
{
    private BaseType $baseType;

    protected function setUp(): void
    {
        parent::setUp();
        $this->baseType = new Thing();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->baseType);
    }

    public function testGetTypeReturnsShortClassName(): void
    {
        $type = $this->baseType->getType();
        $this->assertSame('Thing', $type);
    }

    public function testToStringReturnsFullClassName(): void
    {
        $className = (string) $this->baseType;
        $this->assertSame(Thing::class, $className);
    }

    public function testNameSetsProperty(): void
    {
        $this->baseType->name('Test Name');
        $this->assertEquals('Test Name', $this->baseType->getProperty('name'));
    }

    public function testIdSetsProperty(): void
    {
        $this->baseType->id('test-id-123');
        $this->assertEquals('test-id-123', $this->baseType->getProperty('id'));
    }

    public function testAlternateNameSetsProperty(): void
    {
        $this->baseType->alternateName('Alternative Name');
        $this->assertEquals('Alternative Name', $this->baseType->getProperty('alternateName'));
    }

    public function testUrlSetsProperty(): void
    {
        $this->baseType->url('https://example.com');
        $this->assertEquals('https://example.com', $this->baseType->getProperty('url'));
    }

    public function testInLanguageSetsProperty(): void
    {
        $this->baseType->inLanguage('en');
        $this->assertEquals('en', $this->baseType->getProperty('inLanguage'));
    }

    public function testSetDescriptionSetsProperty(): void
    {
        $this->baseType->setDescription('This is a test description');
        $this->assertEquals('This is a test description', $this->baseType->getProperty('description'));
    }

    public function testSubjectOfSetsPropertyWithBaseType(): void
    {
        $person = new Person();
        $person->name('Subject Person');

        $this->baseType->subjectOf($person);

        $subjectProperty = $this->baseType->getProperty('subjectOf');
        $this->assertIsArray($subjectProperty);
        $this->assertArrayHasKey('@type', $subjectProperty);
        $this->assertEquals('Person', $subjectProperty['@type']);
    }

    public function testGetPropertiesReturnsArray(): void
    {
        $this->baseType->name('Test')->id('123');
        $properties = $this->baseType->getProperties();

        $this->assertArrayHasKey('name', $properties);
        $this->assertArrayHasKey('id', $properties);
    }

    public function testGetPropertiesReturnsEmptyArrayInitially(): void
    {
        $thing = new Thing();
        $properties = $thing->getProperties();

        $this->assertEmpty($properties);
    }

    public function testGetPropertyReturnsNullForNonExistentProperty(): void
    {
        $value = $this->baseType->getProperty('nonexistent');
        $this->assertNull($value);
    }

    public function testFluentInterface(): void
    {
        $baseType = $this->baseType
            ->name('Test')
            ->id('123')
            ->url('https://example.com')
            ->inLanguage('en');

        $this->assertSame($this->baseType, $baseType);
    }

    public function testRenderReturnsJsonLdScript(): void
    {
        $this->baseType->name('Test Thing');
        $rendered = $this->baseType->render();

        $this->assertIsString($rendered);
        $this->assertStringContainsString('<script type="application/ld+json">', $rendered);
        $this->assertStringContainsString('</script>', $rendered);
        $this->assertStringContainsString('"@context"', $rendered);
        $this->assertStringContainsString('"@type"', $rendered);
        $this->assertStringContainsString('https://schema.org', $rendered);
    }

    public function testRenderIncludesProperties(): void
    {
        $this->baseType
            ->name('Test Thing')
            ->id('test-123')
            ->url('https://example.com');

        $rendered = $this->baseType->render();

        $this->assertStringContainsString('Test Thing', (string) $rendered);
        $this->assertStringContainsString('test-123', (string) $rendered);
        $this->assertStringContainsString('https://example.com', (string) $rendered);
    }

    public function testRenderOutputsValidJson(): void
    {
        $this->baseType->name('Test Thing');
        $rendered = $this->baseType->render();

        preg_match('/<script[^>]*>(.*?)<\/script>/s', (string) $rendered, $matches);
        $json = $matches[1] ?? '';

        $decoded = json_decode($json, true);
        $this->assertIsArray($decoded);
        $this->assertArrayHasKey('@context', $decoded);
        $this->assertArrayHasKey('@type', $decoded);
        $this->assertEquals('https://schema.org', $decoded['@context']);
        $this->assertEquals('Thing', $decoded['@type']);
    }

    public function testMultiplePropertiesCanBeSet(): void
    {
        $this->baseType
            ->name('Multiple Properties Test')
            ->id('multi-123')
            ->url('https://example.com')
            ->alternateName('Alt Name')
            ->inLanguage('de')
            ->setDescription('A description');

        $properties = $this->baseType->getProperties();

        $this->assertCount(6, $properties);
        $this->assertEquals('Multiple Properties Test', $properties['name']);
        $this->assertEquals('multi-123', $properties['id']);
        $this->assertEquals('https://example.com', $properties['url']);
        $this->assertEquals('Alt Name', $properties['alternateName']);
        $this->assertEquals('de', $properties['inLanguage']);
        $this->assertEquals('A description', $properties['description']);
    }

    public function testPropertyCanBeOverwritten(): void
    {
        $this->baseType->name('First Name');
        $this->assertEquals('First Name', $this->baseType->getProperty('name'));

        $this->baseType->name('Second Name');
        $this->assertEquals('Second Name', $this->baseType->getProperty('name'));
    }

    public function testRenderWithNestedObject(): void
    {
        $person = new Person();
        $person->name('Nested Person');

        $this->baseType->name('Main Thing')->subjectOf($person);

        $rendered = $this->baseType->render();

        $this->assertStringContainsString('Main Thing', (string) $rendered);
        $this->assertStringContainsString('Person', (string) $rendered);
    }
}
