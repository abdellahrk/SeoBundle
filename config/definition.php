<?php

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

return static function (DefinitionConfigurator $definition) {
    $definition->rootNode()
        ->children()
            ->arrayNode('seo')
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
            ->end()
        ->end();
};
