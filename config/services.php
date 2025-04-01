<?php

use Rami\SeoBundle\Metas\MetaTags;
use Rami\SeoBundle\Metas\MetaTagsInterface;
use Rami\SeoBundle\Schema\Schema;
use Rami\SeoBundle\Schema\SchemaInterface;
use Rami\SeoBundle\Twig\Extensions\MetaTagsExtension;
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
    $services->set('seo.meta.tags', MetaTags::class)->tag('kernel.reset', ['method' => 'reset']);
    $services->alias(MetaTagsInterface::class, 'seo.meta.tags');
    $services->set(MetaTagsExtension::class, MetaTagsExtension::class)
        ->autowire()
        ->tag('twig.extension');
//    $services->set('open.graph', MetaTags::class)->tag('kernel.reset', ['method' => 'reset']);
};