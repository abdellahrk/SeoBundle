<?php

use Abdellahramadan\SeoBundle\Schema\Schema;
use Abdellahramadan\SeoBundle\Schema\SchemaInterface;
use Abdellahramadan\SeoBundle\Twig\Extensions\SchemaOrgExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set(Schema::class, Schema::class)->autowire();
    $services->alias(SchemaInterface::class, Schema::class);
    $services->set(SchemaOrgExtension::class, SchemaOrgExtension::class)
        ->autowire()
        ->tag('twig.extension');
};