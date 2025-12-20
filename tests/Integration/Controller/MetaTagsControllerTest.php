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

namespace Rami\SeoBundle\Test\Integration\Controller;

use PHPUnit\Framework\TestCase;
use Rami\SeoBundle\Metas\MetaTagsManager;
use Rami\SeoBundle\Metas\Model\SeoMeta;

use function assert;
use function is_array;

final class MetaTagsControllerTest extends TestCase
{
    private MetaTagsManager $metaTagsManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->metaTagsManager = new MetaTagsManager();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->metaTagsManager);
    }

    public function testSetAndGetTitle(): void
    {
        $title = 'Test Page Title';
        $this->metaTagsManager->setTitle($title);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($title, $seoMeta->getTitle());
    }

    public function testSetAndGetDescription(): void
    {
        $description = 'This is a test description for SEO purposes';
        $this->metaTagsManager->setDescription($description);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($description, $seoMeta->getDescription());
    }

    public function testSetAndGetKeywords(): void
    {
        $keywords = ['seo', 'symfony', 'bundle', 'testing'];
        $this->metaTagsManager->setKeywords($keywords);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($keywords, $seoMeta->getKeywords());
    }

    public function testSetAndGetSubject(): void
    {
        $subject = 'SEO and Web Development';
        $this->metaTagsManager->setSubject($subject);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($subject, $seoMeta->getSubject());
    }

    public function testSetAndGetCopyright(): void
    {
        $copyright = '© 2025 Test Company';
        $this->metaTagsManager->setCopyright($copyright);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($copyright, $seoMeta->getCopyright());
    }

    public function testSetAndGetRobots(): void
    {
        $robots = ['index', 'follow'];
        $this->metaTagsManager->setRobots($robots);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($robots, $seoMeta->getRobots());
    }

    public function testSetAndGetViewPort(): void
    {
        $viewport = 'width=device-width, initial-scale=1.0';
        $this->metaTagsManager->setViewPort($viewport);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($viewport, $seoMeta->getViewport());
    }

    public function testSetAndGetCanonical(): void
    {
        $canonical = 'https://example.com/page';
        $this->metaTagsManager->setCanonical($canonical);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($canonical, $seoMeta->getCanonical());
    }

    public function testSetAndGetCharacterEncoding(): void
    {
        $charset = 'UTF-8';
        $this->metaTagsManager->setCharacterEncoding($charset);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($charset, $seoMeta->getCharset());
    }

    public function testSetCharacterEncodingWithDefaultValue(): void
    {
        $this->metaTagsManager->setCharacterEncoding();

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame('UTF-8', $seoMeta->getCharset());
    }

    public function testSetAndGetAuthor(): void
    {
        $author = 'John Doe';
        $this->metaTagsManager->setAuthor($author);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($author, $seoMeta->getAuthor());
    }

    public function testSetAndGetContentSecurityPolicy(): void
    {
        $csp = "default-src 'self'; script-src 'self' 'unsafe-inline'";
        $this->metaTagsManager->setContentSecurityPolicy($csp);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($csp, $seoMeta->getContentSecurityPolicy());
    }

    public function testSetAndGetContentType(): void
    {
        $contentType = 'text/html; charset=UTF-8';
        $this->metaTagsManager->setContentType($contentType);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame($contentType, $seoMeta->getContentType());
    }

    public function testFluentInterface(): void
    {
        $metaTagsManager = $this->metaTagsManager
            ->setTitle('Test Title')
            ->setDescription('Test Description')
            ->setKeywords(['test', 'seo'])
            ->setAuthor('Test Author');

        $this->assertInstanceOf(MetaTagsManager::class, $metaTagsManager);
        $this->assertSame($this->metaTagsManager, $metaTagsManager);
    }

    public function testSetCustomMetaTag(): void
    {
        $this->metaTagsManager->setCustomMetaTag('custom-tag', 'custom-value');

        $metaTags = $this->metaTagsManager->getMetaTags();
        $this->assertArrayHasKey('custom-tag', $metaTags);
        $this->assertEquals('custom-value', $metaTags['custom-tag']);
    }

    public function testSetMultipleCustomMetaTags(): void
    {
        $this->metaTagsManager
            ->setCustomMetaTag('tag1', 'value1')
            ->setCustomMetaTag('tag2', 'value2')
            ->setCustomMetaTag('tag3', 'value3');

        $metaTags = $this->metaTagsManager->getMetaTags();
        $this->assertCount(3, $metaTags);
        $this->assertEquals('value1', $metaTags['tag1']);
        $this->assertEquals('value2', $metaTags['tag2']);
        $this->assertEquals('value3', $metaTags['tag3']);
    }

    public function testSetDefaultStyle(): void
    {
        $style = 'main-style';
        $this->metaTagsManager->setDefaultStyle($style);

        $metaTags = $this->metaTagsManager->getMetaTags();
        $this->assertArrayHasKey('default-style', $metaTags);
        $defaultStyle = $metaTags['default-style'];
        assert(is_array($defaultStyle));
        $this->assertEquals('Default-Style', $defaultStyle['http-equiv']);
        $this->assertEquals($style, $defaultStyle['value']);
    }

    public function testSetXUACompatible(): void
    {
        $this->metaTagsManager->setXUACompatible();

        $metaTags = $this->metaTagsManager->getMetaTags();
        $this->assertArrayHasKey('x-ua-compatible', $metaTags);
        $xuaCompatible = $metaTags['x-ua-compatible'];
        assert(is_array($xuaCompatible));
        $this->assertEquals('X-UA-Compatible', $xuaCompatible['http-equiv']);
        $this->assertEquals('IE=edge', $xuaCompatible['value']);
    }

    public function testSetAlternate(): void
    {
        $href = 'https://example.com/alternate';
        $media = 'screen';
        $this->metaTagsManager->setAlternate($href, $media);

        $metaTags = $this->metaTagsManager->getMetaTags();
        $this->assertArrayHasKey('rel', $metaTags);
        $rel = $metaTags['rel'];
        assert(is_array($rel));
        $this->assertEquals('canonical', $rel['rel']);
        $this->assertEquals($href, $rel['href']);
        $this->assertEquals($media, $rel['media']);
    }

    public function testSetAlternateWithoutMedia(): void
    {
        $href = 'https://example.com/alternate';
        $this->metaTagsManager->setAlternate($href);

        $metaTags = $this->metaTagsManager->getMetaTags();
        $this->assertArrayHasKey('rel', $metaTags);
        $rel = $metaTags['rel'];
        assert(is_array($rel));
        $this->assertEquals('canonical', $rel['rel']);
        $this->assertEquals($href, $rel['href']);
        $this->assertEquals('', $rel['media']);
    }

    public function testGetMetaTagsReturnsArray(): void
    {
        $this->metaTagsManager->setCustomMetaTag('test', 'value');

        $metaTags = $this->metaTagsManager->getMetaTags();
        $this->assertNotEmpty($metaTags);
    }

    public function testGetMetaTagsReturnsEmptyArrayInitially(): void
    {
        $metaTags = $this->metaTagsManager->getMetaTags();
        $this->assertEmpty($metaTags);
    }

    public function testGetSeoMetaReturnsSeoMetaInstance(): void
    {
        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertInstanceOf(SeoMeta::class, $seoMeta);
    }

    public function testReset(): void
    {
        $this->metaTagsManager
            ->setTitle('Test Title')
            ->setDescription('Test Description')
            ->setKeywords(['test', 'keywords'])
            ->setCustomMetaTag('custom', 'value');

        $this->metaTagsManager->reset();

        $metaTags = $this->metaTagsManager->getMetaTags();
        $this->assertEmpty($metaTags);

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertEmpty($seoMeta->getTitle());
        $this->assertEmpty($seoMeta->getDescription());
        $this->assertEmpty($seoMeta->getKeywords());
    }

    public function testResetClearsSeoMeta(): void
    {
        $this->metaTagsManager
            ->setTitle('Title')
            ->setDescription('Description')
            ->setAuthor('Author')
            ->setCanonical('https://example.com')
            ->setCharacterEncoding('ISO-8859-1');

        $this->metaTagsManager->reset();

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertInstanceOf(SeoMeta::class, $seoMeta);
        $this->assertEmpty($seoMeta->getTitle());
        $this->assertEmpty($seoMeta->getDescription());
        $this->assertEmpty($seoMeta->getAuthor());
        $this->assertEmpty($seoMeta->getCanonical());
        $this->assertEmpty($seoMeta->getCharset());
    }

    public function testComplexMetaTagsScenario(): void
    {
        $this->metaTagsManager
            ->setTitle('E-Commerce Product Page')
            ->setDescription('Buy the best products online with free shipping')
            ->setKeywords(['e-commerce', 'shopping', 'products', 'online'])
            ->setAuthor('Shop Team')
            ->setRobots(['index', 'follow'])
            ->setCanonical('https://shop.example.com/products/item-123')
            ->setViewPort('width=device-width, initial-scale=1.0')
            ->setCharacterEncoding('UTF-8')
            ->setCopyright('© 2025 Shop Example')
            ->setSubject('E-Commerce')
            ->setXUACompatible()
            ->setCustomMetaTag('og:type', 'product')
            ->setCustomMetaTag('og:price:amount', '99.99');

        $seoMeta = $this->metaTagsManager->getSeoMeta();
        $this->assertSame('E-Commerce Product Page', $seoMeta->getTitle());
        $this->assertSame('Buy the best products online with free shipping', $seoMeta->getDescription());
        $this->assertCount(4, $seoMeta->getKeywords());
        $this->assertSame('Shop Team', $seoMeta->getAuthor());
        $this->assertSame(['index', 'follow'], $seoMeta->getRobots());

        $metaTags = $this->metaTagsManager->getMetaTags();
        $this->assertArrayHasKey('x-ua-compatible', $metaTags);
        $this->assertArrayHasKey('og:type', $metaTags);
        $this->assertEquals('product', $metaTags['og:type']);
        $this->assertEquals('99.99', $metaTags['og:price:amount']);
    }
}
