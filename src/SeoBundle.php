<?php

namespace Abdellahramadan\SeoBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class SeoBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }
    
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.php');
        $container->parameters()->set('schema', 'schema');
        $container->parameters()->set('meta_tags', 'meta_tags');
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->arrayNode('schema')
                    ->children()

                    ->end()
                ->end()
                ->arrayNode('meta_tags')
                    ->children()
                        ->scalarNode('title')->end()
                        ->scalarNode('description')->end()
                        ->arrayNode('keywords')
                            ->info('Meta keywords')->example('meta, keyword')
                        ->end()
                ->end()
            ->end();
    }
}