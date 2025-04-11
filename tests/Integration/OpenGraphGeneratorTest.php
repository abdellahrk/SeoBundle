<?php

namespace Rami\SeoBundle\Tests\Integration;
/*
 * Copyright (c) 2025.
 *
 * This file is part of the SEO Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */


use Rami\SeoBundle\OpenGraph\OpenGraphManagerInterface;
use Rami\SeoBundle\Sitemap\SitemapInterface;
use Rami\SeoBundle\Test\Integration\TestApp;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class OpenGraphGeneratorTest extends KernelTestCase
{
    protected ContainerInterface $container;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = new TestApp('test', true);
        $kernel->boot();
        $this->container = $kernel->getContainer();
    }

    protected function tearDown(): void
    {
        self::ensureKernelShutdown();
    }


    public function testsimpleTest(): void
    {
        self::bootKernel();

        $og = static::getContainer()->get(OpenGraphManagerInterface::class);
        $this->assertTrue(true);
    }
}