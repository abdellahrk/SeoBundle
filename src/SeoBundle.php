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
    /**
     * @param array<string, mixed> $config
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.php');
        $container->parameters()->set('seo.meta_tags', $config['meta_tags'] ?? null);
        $container->parameters()->set('seo.open_graph', $config['open_graph'] ?? null);
        $container->parameters()->set('seo.sitemap', $config['sitemap'] ?? null);

        $googleTagManager = $config['google_tag_manager'] ?? [];
        assert(is_array($googleTagManager));
        if (($googleTagManager['enabled'] ?? false)) {
            $container->parameters()->set('seo.google_tag_manager', $googleTagManager);
        }

        $schema = $config['schema'] ?? [];
        assert(is_array($schema));
        if (($schema['enabled'] ?? false)) {
            $container->parameters()->set('seo.schema', $schema);
        }

        $metaPixel = $config['meta_pixel'] ?? [];
        assert(is_array($metaPixel));
        if (($metaPixel['enabled'] ?? false)) {
            $container->parameters()->set('seo.meta_pixel', $metaPixel);
        }
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->import('../config/definition.php');
    }

    public function getPath(): string
    {
        $reflectionObject = new ReflectionObject($this);

        /** @var string $fileName */
        $fileName = $reflectionObject->getFileName();

        return dirname($fileName, 2);
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new GoogleTagCompilerPass());
        $container->addCompilerPass(new MetaPixelCompilerPass());
    }
}
