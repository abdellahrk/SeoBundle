<?php

namespace Rami\SeoBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class SeoBundle extends AbstractBundle
{
//    public function getPath(): string
//    {
//        return __DIR__;
//    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.php');
        $container->parameters()->set('seo.schema', $config['schema'] ?? null);
        $container->parameters()->set('seo.meta_tags', $config['meta_tags'] ?? null);
        $container->parameters()->set('seo.open_graph', $config['open_graph'] ?? null);
        $container->parameters()->set('seo.sitemap', $config['sitemap'] ?? null);

    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->import('../config/definition.php');
    }

    public function getPath(): string
    {
        $reflected = new \ReflectionObject($this);

        return \dirname($reflected->getFileName(), 2);
    }
}