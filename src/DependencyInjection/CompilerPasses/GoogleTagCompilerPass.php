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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class GoogleTagCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        // in this method you can manipulate the service container:
        // for example, changing some container service:
//        $container->getDefinition('app.some_private_service')->setPublic(true);
        
        if (!$container->getDefinition('seo.google_tag_manager')) {
            return;
        }

        if (!$container->getParameter('seo.google_tag_manager')) {
            return;
        }

        $definition = $container->getDefinition('seo.google_tag_manager');

        // or processing tagged services:
        foreach ($container->findTaggedServiceIds('seo.google_tag_manager') as $id => $tags) {
            $definition->addMethodCall('enableGoogleTagManager',[
                $container->getParameter('seo.google_tag_manager')['tag_manager_id'],
                $container->getParameter('seo.google_tag_manager')['analytics_id'],
            ]);
        }
    }
}
