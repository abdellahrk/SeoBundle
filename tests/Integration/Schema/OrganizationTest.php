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
use Rami\SeoBundle\Schema\Thing\Organization;

final class OrganizationTest extends TestCase
{
    private Organization $organization;

    protected function setUp(): void
    {
        parent::setUp();
        $this->organization = new Organization();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->organization);
    }

    public function testGetTypeReturnsOrganization(): void
    {
        $this->assertSame('Organization', $this->organization->getType());
    }

    public function testInheritsFromThing(): void
    {
        $this->organization->name('Test Organization');
        $this->assertEquals('Test Organization', $this->organization->getProperty('name'));
    }

    public function testFluentInterface(): void
    {
        $baseType = $this->organization
            ->name('Tech Company')
            ->url('https://techcompany.com');

        $this->assertSame($this->organization, $baseType);
    }

    public function testRenderOutputsValidJsonLd(): void
    {
        $this->organization
            ->name('Tech Company Ltd')
            ->url('https://techcompany.com')
            ->setDescription('A leading technology company');

        $rendered = $this->organization->render();

        $this->assertStringContainsString('"@type": "Organization"', (string) $rendered);
        $this->assertStringContainsString('Tech Company Ltd', (string) $rendered);
        $this->assertStringContainsString('https://techcompany.com', (string) $rendered);
    }

    public function testOrganizationUsesTraits(): void
    {
        $this->organization->name('Company with Traits');
        $properties = $this->organization->getProperties();

        $this->assertArrayHasKey('name', $properties);
        $this->assertEquals('Company with Traits', $properties['name']);
    }
}
