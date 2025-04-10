<?php

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
use Rami\SeoBundle\Twig\Extensions\MetaTagsExtension;
use Rami\SeoBundle\Twig\Extensions\OpenGraphExtension;
use Rami\SeoBundle\Twig\Extensions\SchemaOrgExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set('seo.schema.tags', Schema::class);
    $services->alias(SchemaInterface::class, 'seo.schema.tags');
    $services->set(SchemaOrgExtension::class, SchemaOrgExtension::class)
        ->autowire()
        ->tag('twig.extension');
    $services->set('seo.meta.tags', MetaTagsManager::class)->tag('kernel.reset', ['method' => 'reset']);
    $services->alias(MetaTagsManagerInterface::class, 'seo.meta.tags');
    $services->set(MetaTagsExtension::class, MetaTagsExtension::class)
        ->autowire()
        ->tag('twig.extension');
    $services->set('seo.sitemap', Sitemap::class);
    $services->alias(SitemapInterface::class, 'seo.sitemap')->public();
    $services->set('open.graph.bundle', OpenGraphManager::class);
    $services->alias(OpenGraphManagerInterface::class, 'open.graph.bundle')->public();
    $services->set('open.graph.bundle.twig.extension', OpenGraphExtension::class)
        ->tag('twig.extension');
    $services->set('open.graph', OpenGraphManager::class)->tag('kernel.reset', ['method' => 'reset']);
    $services->set('seo.generate.site.map', GenerateSitemapCommand::class)->tag('console.command');
    $services->set('seo.generate.sitemap.message', GenerateSitemapMessageHandler::class)->tag('message.message_handler');
    $services->set('seo.update.sitemap.event', class: UpdateSitemapEventListener::class)->tag('kernel.event_listener');

    $services
        ->set(SeoCollector::class)
        ->tag('data_collector',
            [
                'id' => SeoCollector::class,
                'template' => '@Seo/seo/data_collector.html.twig'
            ]);

    // Open Graph
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
};