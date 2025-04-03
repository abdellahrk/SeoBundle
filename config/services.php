<?php

use Rami\SeoBundle\Metas\MetaTags;
use Rami\SeoBundle\Metas\MetaTagsInterface;
use Rami\SeoBundle\OpenGraph\OpenGraph;
use Rami\SeoBundle\OpenGraph\OpenGraphInterface;
use Rami\SeoBundle\Schema\Schema;
use Rami\SeoBundle\Schema\SchemaInterface;
use Rami\SeoBundle\Sitemap\Sitemap;
use Rami\SeoBundle\Sitemap\SitemapInterface;
use Rami\SeoBundle\Twig\Extensions\MetaTagsExtension;
use Rami\SeoBundle\Twig\Extensions\OpenGraphExtension;
use Rami\SeoBundle\Twig\Extensions\SchemaOrgExtension;
use Rami\SeoBundle\Utils\RouterService;
use Rami\SeoBundle\Utils\RouterServiceInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

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
    $services->set('seo.meta.tags', MetaTags::class)->tag('kernel.reset', ['method' => 'reset']);
    $services->alias(MetaTagsInterface::class, 'seo.meta.tags');
    $services->set(MetaTagsExtension::class, MetaTagsExtension::class)
        ->autowire()
        ->tag('twig.extension');
    $services->set('seo.router.service', RouterService::class)->autowire()->arg('$router', new Reference('router'))->autowire()->autoconfigure();
    $services->alias(RouterServiceInterface::class, 'seo.router.service');
    $services->set('seo.sitemap', Sitemap::class)->args(['$publicDir' => '%kernel.project_dir%/public/', '$routerService' => new Reference('seo.router.service')]);
    $services->alias(SitemapInterface::class, 'seo.sitemap');
    $services->set('open.graph.bundle', OpenGraph::class);
    $services->alias(OpenGraphInterface::class, 'open.graph.bundle');
    $services->set('open.graph.bundle.twig.extension', OpenGraphExtension::class)
        ->tag('twig.extension');
    $services->set('open.graph', OpenGraph::class)->tag('kernel.reset', ['method' => 'reset']);
};