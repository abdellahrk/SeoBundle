<?php

use Abdellahramadan\SeoBundle\Metas\MetaTags;
use Abdellahramadan\SeoBundle\Metas\MetaTagsInterface;
use Abdellahramadan\SeoBundle\Schema\Schema;
use Abdellahramadan\SeoBundle\Schema\SchemaInterface;
use Abdellahramadan\SeoBundle\Twig\Extensions\MetaTagsExtension;
use Abdellahramadan\SeoBundle\Twig\Extensions\SchemaOrgExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set('seo.schema.tags', Schema::class);
    $services->alias(SchemaInterface::class, 'seo.schema.tags');
    $services->set('seo.meta.tags', MetaTags::class);
    $services->set(SchemaOrgExtension::class, SchemaOrgExtension::class)
        ->autowire()
        ->tag('twig.extension');
    $services->set(MetaTagsExtension::class, MetaTagsExtension::class)
        ->autowire()
        ->tag('twig.extension');
    $services->set('open.graph', MetaTags::class)->tag('kernel.reset', ['method' => 'reset']);
    $services->alias(MetaTagsInterface::class, 'open.graph');

};