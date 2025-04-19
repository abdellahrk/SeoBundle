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

namespace Rami\SeoBundle\DependencyInjection\CompilerPasses;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MetaPixelCompilerPass implements CompilerPassInterface
{

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('seo.meta_pixel')) {
            return;
        }

        $definition = $container->getDefinition('seo.meta_pixel');

        if (!$container->hasParameter('seo.meta_pixel')) {
            return;
        }

        foreach ($container->findTaggedServiceIds('seo.meta_pixel') as $id => $tags) {
            $definition->addMethodCall('enableMetaPixel', [
                $container->getParameter('seo.meta_pixel')['pixel_id'],
            ]);
        }
    }
}