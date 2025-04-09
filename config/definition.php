<?php

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

return static function (DefinitionConfigurator $definition) {
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
                    ->end()
                    ->arrayNode('open_graph')
                        ->children()
                            ->scalarNode('sitename')->info('Default og sitename')->end()
                            ->scalarNode('type')->info('Default og type')->end()
                            ->scalarNode('title')->info('Default og title')->end()
                            ->scalarNode('description')->info('Default og description')->end()
                            ->scalarNode('url')->info('Default og URL')->end()
                        ->end()
                    ->end()
                    ->arrayNode('sitemap')
                        ->children()

                        ->end()
                    ->end()
                ->end();
};
