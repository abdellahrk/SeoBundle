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

declare(strict_types=1);

namespace Rami\SeoBundle\DependencyInjection\CompilerPasses;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class GoogleTagCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has('seo.google_tag_manager')) {
            return;
        }

        $definition = $container->getDefinition('seo.google_tag_manager');

        if (!$container->hasParameter('seo.google_tag_manager')) {
            return;
        }

        foreach ($container->findTaggedServiceIds('seo.google_tag_manager') as $tags) {
            $definition->addMethodCall('enableGoogleTagManager', [
                $container->getParameter('seo.google_tag_manager')['tag_manager_id'],
            ]);
        }
    }
}
