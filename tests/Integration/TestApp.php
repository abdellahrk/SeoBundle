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

namespace Rami\SeoBundle\Test\Integration;

use Rami\SeoBundle\SeoBundle;
use Rami\SeoBundle\Utils\RouterService;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;


class TestApp extends Kernel
{

    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new SeoBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {


        $loader->load(function (ContainerBuilder $container) {
            $confDir = $this->getProjectDir().'/tests/config';
            if ('test' === $this->getEnvironment()) {
                // Load your custom test services
                $yamlLoader = new YamlFileLoader($container, new FileLocator($confDir));
                $yamlLoader->load('services_test.yaml');
            }
            $container->loadFromExtension('framework', [
                'secret' => 'test',
                'test' => true,
            ]);
        });
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir() . '/rami_bundle_cache';
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir() . '/rami_bundle_logs';
    }
}