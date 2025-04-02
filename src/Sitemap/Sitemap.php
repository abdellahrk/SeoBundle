<?php

namespace Rami\SeoBundle\Sitemap;

use Rami\SeoBundle\Utils\RouterService;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Sitemap implements SitemapInterface
{
    public function __construct(
        #[Autowire('%kernel.project_dir%/public/')] private string $publicDir,
        private RouterService $routerService,
        private UrlGeneratorInterface $urlGenerator,
        private RequestStack $requestStack,
    ) {}

    public function generateSitemap(): void
    {

        $handler = fopen(filename: $this->publicDir . 'sitemap.xml', mode: 'w+');
        fwrite($handler, sprintf('<?xml version="1.0" encoding="UTF-8"?>%s<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">%s'.PHP_EOL, PHP_EOL, PHP_EOL));
        $routes = $this->routerService->getRoutes();
        $metadata = stream_get_meta_data($handler);
        $filename = $metadata['uri'];

        $request = $this->requestStack->getCurrentRequest();

        $allRoutes = [];

        foreach ($routes as $name => $route) {

            if (str_starts_with($name, '_profiler') || str_starts_with($name, 'app_show_blog') || str_starts_with($name, 'app_edit_blog') || str_starts_with($name, '_preview_error') || str_starts_with($name, '_wdt') || str_starts_with($name, '_debug')) {
                continue;
            }

            $controller = explode(':', $route->getDefaults()['_controller'])[0];
            $ref = new \ReflectionClass($controller);
            foreach ($ref->getMethods() as $method) {
                $attributes = $method->getAttributes();
                $currentRoute = null;
                if (count($attributes) > 1) {
                  $sitemapAttribute = false;
                  $routerExists = false;

                    foreach ($attributes as $attribute) {
                        $instance = $attribute->newInstance();
                        if ($instance instanceof \Rami\SeoBundle\Sitemap\Attributes\Sitemap) {
                            $sitemapAttribute = true;
                        }
                        if ($instance instanceof Route || $instance instanceof \Symfony\Component\Routing\Annotation\Route) {
                            $routerExists = true;
                            $currentRoute = $instance;
                        }
                    }

                    if (!$sitemapAttribute || !$routerExists) {
                        continue;
                    }
                    $allRoutes[] = $currentRoute;

                }
            }
        }

        $allRoutes = array_unique($allRoutes, SORT_REGULAR);

        foreach ($allRoutes as $route) {
            file_put_contents($filename, sprintf('<url>%s<loc>%s</loc>%s</url>%s', PHP_EOL, $this->urlGenerator->generate($route->getName(), [], UrlGeneratorInterface::ABSOLUTE_URL), PHP_EOL, PHP_EOL), FILE_APPEND,);

        }

        file_put_contents($filename, '</urlset>', FILE_APPEND);
        fclose($handler);
    }

}