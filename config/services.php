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

use Rami\SeoBundle\Breadcrumb\BreadcrumbManager;
use Rami\SeoBundle\Breadcrumb\BreadcrumbManagerInterface;
use Rami\SeoBundle\EventSubscriber\MetaPixelInjectorSubscriber;
use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Seo\GoogleTagManager\TagManager;
use Rami\SeoBundle\Seo\GoogleTagManager\TagManagerInterface;
use Rami\SeoBundle\Seo\MetaPixel\MetaPixel;
use Rami\SeoBundle\Seo\MetaPixel\MetaPixelInterface;
use Rami\SeoBundle\EventSubscriber\GoogleTagInjectorSubscriber;
use Rami\SeoBundle\EventSubscriber\SchemaTwigInjectorSubscriber;
use Rami\SeoBundle\Command\GenerateSitemapCommand;
use Rami\SeoBundle\DataCollector\SeoCollector;
use Rami\SeoBundle\Metas\MetaTagsManager;
use Rami\SeoBundle\Metas\MetaTagsManagerInterface;
use Rami\SeoBundle\OpenGraph\OGArticleManager;
use Rami\SeoBundle\OpenGraph\OGArticleManagerInterface;
use Rami\SeoBundle\OpenGraph\OGAudioManager;
use Rami\SeoBundle\OpenGraph\OGAudioManagerInterface;
use Rami\SeoBundle\OpenGraph\OGImageManager;
use Rami\SeoBundle\OpenGraph\OGImageManagerInterface;
use Rami\SeoBundle\OpenGraph\OGVideoManager;
use Rami\SeoBundle\OpenGraph\OGVideoManagerInterface;
use Rami\SeoBundle\OpenGraph\OpenGraphManager;
use Rami\SeoBundle\OpenGraph\OpenGraphManagerInterface;
use Rami\SeoBundle\Schema\Schema;
use Rami\SeoBundle\Schema\SchemaInterface;
use Rami\SeoBundle\Sitemap\EventHandler\UpdateSitemapEventListener;
use Rami\SeoBundle\Sitemap\MessageHandler\GenerateSitemapMessageHandler;
use Rami\SeoBundle\Sitemap\Sitemap;
use Rami\SeoBundle\Sitemap\SitemapInterface;
use Rami\SeoBundle\Twig\Extensions\BreadcrumbExtension;
use Rami\SeoBundle\Twig\Extensions\MetaTagsExtension;
use Rami\SeoBundle\Twig\Extensions\OpenGraphExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    // Schema Org 
    $services->set('seo.schema', Schema::class)->tag('seo.schema');
    $services->alias(SchemaInterface::class, 'seo.schema');

    $services
        ->set(SchemaTwigInjectorSubscriber::class)
        ->args([new Reference(SchemaInterface::class)])
        ->tag('kernel.event_subscriber');
    $services->set(BaseType::class);
    // End Schema Org

    // Meta Tags
    $services->set('seo.meta.tags', MetaTagsManager::class)->tag('kernel.reset', ['method' => 'reset']);
    $services->alias(MetaTagsManagerInterface::class, 'seo.meta.tags');
    $services->set(MetaTagsExtension::class, MetaTagsExtension::class)
        ->autowire();

    $services->set('seo.sitemap', Sitemap::class);
    $services->alias(SitemapInterface::class, 'seo.sitemap')->public();

    // Open Graph
    $services->set('open.graph.bundle', OpenGraphManager::class);
    $services->alias(OpenGraphManagerInterface::class, 'open.graph.bundle')->public();

    $services->set('open.graph.bundle.twig.extension', OpenGraphExtension::class);

    $services->set('open.graph', OpenGraphManager::class)->tag('kernel.reset', ['method' => 'reset']);

    $services->set('seo.og.image_manager', OGImageManager::class);
    $services
        ->alias( OGImageManagerInterface::class, 'seo.og.image_manager')
        ->public();

    $services->set('seo.og.video_manager', OGVideoManager::class);
    $services
        ->alias(OGVideoManagerInterface::class, 'seo.og.video_manager')
        ->public();

    $services->set('seo.og.audio_manager', OGAudioManager::class);
    $services->alias(OGAudioManagerInterface::class, 'seo.og.audio_manager');

    $services->set('seo.og.article_manager', OGArticleManager::class);
    $services->alias(OGArticleManagerInterface::class, 'seo.og.article_manager');

    $services
        ->set('seo.generate.site.map', GenerateSitemapCommand::class)
        ->tag('console.command');

    $services
        ->set('seo.generate.sitemap.message', GenerateSitemapMessageHandler::class)
        ->tag('message.message_handler');

    $services
        ->set('seo.update.sitemap.event', class: UpdateSitemapEventListener::class)
        ->tag('kernel.event_listener');

    $services
        ->set(SeoCollector::class)
        ->tag('data_collector',
            [
                'id' => SeoCollector::class,
                'template' => '@Seo/data_collector.html.twig'
            ]);

    $services
        ->set('seo.google_tag_manager', TagManager::class)
        ->tag('seo.google_tag_manager');
    $services->alias(TagManagerInterface::class, 'seo.google_tag_manager');

    $services
        ->set(GoogleTagInjectorSubscriber::class)
        ->arg('$tagManager', new Reference(TagManagerInterface::class))
        ->tag('kernel.event_subscriber');

    $services
        ->set('seo.meta_pixel', MetaPixel::class)
        ->tag('seo.meta_pixel');
    $services->alias(MetaPixelInterface::class, 'seo.meta_pixel');

    $services
        ->set(MetaPixelInjectorSubscriber::class)
        ->arg('$metaPixel', new Reference(MetaPixelInterface::class))
        ->tag('kernel.event_subscriber');

    $services
        ->set('seo.breadcrumb', BreadcrumbManager::class)
        ->tag('seo.breadcrumb');
    $services
        ->alias(BreadcrumbManagerInterface::class, 'seo.breadcrumb')->public();
    $services
        ->set(BreadcrumbExtension::class, BreadcrumbExtension::class)
        ->autowire();
};