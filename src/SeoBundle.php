<?php

declare(strict_types=1);

/*
 * Copyright (c) 2025.
 *
 * This file is part of the SEO Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\SeoBundle;

use Rami\SeoBundle\DependencyInjection\CompilerPasses\GoogleTagCompilerPass;
use Rami\SeoBundle\DependencyInjection\CompilerPasses\MetaPixelCompilerPass;
use ReflectionObject;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

use function dirname;

class SeoBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.php');
        $container->parameters()->set('seo.meta_tags', $config['meta_tags'] ?? null);
        $container->parameters()->set('seo.open_graph', $config['open_graph'] ?? null);
        $container->parameters()->set('seo.sitemap', $config['sitemap'] ?? null);

        if ($config['google_tag_manager']['enabled']) {
            $container->parameters()->set('seo.google_tag_manager', $config['google_tag_manager']);
        }

        if ($config['schema']['enabled']) {
            $container->parameters()->set('seo.schema', $config['schema']);
        }

        if ($config['meta_pixel']['enabled']) {
            $container->parameters()->set('seo.meta_pixel', $config['meta_pixel']);
        }
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->import('../config/definition.php');
    }

    public function getPath(): string
    {
        $reflectionObject = new ReflectionObject($this);

        return dirname($reflectionObject->getFileName(), 2);
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new GoogleTagCompilerPass());
        $container->addCompilerPass(new MetaPixelCompilerPass());
    }
}
