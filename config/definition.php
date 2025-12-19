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

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

return static function (DefinitionConfigurator $definition) {
    $definition->rootNode()
        ->children()
                    ->arrayNode('schema')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->booleanNode('enabled')->defaultFalse()->end()
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
                    ->arrayNode('google_tag_manager')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('tag_manager_id')->defaultNull()->end()
                            ->scalarNode('analytics_id')->defaultNull()->end()
                            ->booleanNode('enabled')->defaultFalse()->end()
                        ->end()
                    ->end()
                    ->arrayNode('meta_pixel')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('pixel_id')->defaultNull()->end()
                            ->booleanNode('enabled')->defaultFalse()->end()
                        ->end()
                    ->end()
                ->end();
};
