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
use Rami\SeoBundle\Schema\Thing\Organization;

class OrganizationTest extends TestCase
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
        $this->assertEquals('Organization', $this->organization->getType());
    }

    public function testInheritsFromThing(): void
    {
        $this->organization->name('Test Organization');
        $this->assertEquals('Test Organization', $this->organization->getProperty('name'));
    }

    public function testFluentInterface(): void
    {
        $result = $this->organization
            ->name('Tech Company')
            ->url('https://techcompany.com');

        $this->assertSame($this->organization, $result);
    }

    public function testRenderOutputsValidJsonLd(): void
    {
        $this->organization
            ->name('Tech Company Ltd')
            ->url('https://techcompany.com')
            ->setDescription('A leading technology company');

        $rendered = $this->organization->render();

        $this->assertStringContainsString('"@type": "Organization"', $rendered);
        $this->assertStringContainsString('Tech Company Ltd', $rendered);
        $this->assertStringContainsString('https://techcompany.com', $rendered);
    }

    public function testOrganizationUsesTraits(): void
    {
        $this->organization->name('Company with Traits');
        $properties = $this->organization->getProperties();

        $this->assertArrayHasKey('name', $properties);
        $this->assertEquals('Company with Traits', $properties['name']);
    }
}
