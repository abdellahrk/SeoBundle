<?php

namespace Rami\SeoBundle\Sitemap;

use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Rami\SeoBundle\Utils\RouterService;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
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
        private ManagerRegistry $managerRegistry,
        private ParameterBagInterface $parameterBag,
        private LoggerInterface $logger
    ) {}

    public function generateSitemap(): void
    {
        $this->logger->info('Generating sitemap');

        $handler = fopen(filename: $this->publicDir . 'sitemap.xml', mode: 'w+');
        fwrite($handler, sprintf('<?xml version="1.0" encoding="UTF-8"?>%s<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">%s'.PHP_EOL, PHP_EOL, PHP_EOL));
        $routes = $this->routerService->getRoutes();
        $metadata = stream_get_meta_data($handler);
        $filename = $metadata['uri'];
        if (false === file_exists($this->publicDir . 'sitemaps')) mkdir($this->publicDir . 'sitemaps');

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
                            if (null !== $instance->entityClass) {
                                $this->generateDynamicSitemap($attributes);
                                break 1;
                            }
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

    public function generateDynamicSitemap(array $attributes): void
    {
        $route = null;
        $sitemap = null;
        foreach ($attributes as $attribute) {
            $attribute = $attribute->newInstance();
            if ($attribute instanceof Route || $attribute instanceof \Symfony\Component\Routing\Annotation\Route) {
                $route = $attribute;
            }

            if ($attribute instanceof \Rami\SeoBundle\Sitemap\Attributes\Sitemap) {
                $sitemap = $attribute;
            }
        }
        if (null === $route) {
            return;
        }

        if (null === $sitemap) {
            return;
        }

        $defaultFilename = explode("\\", $sitemap->entityClass);
        $fileName = $sitemap->fileName ? $sitemap->fileName . '.xml': strtolower(end($defaultFilename)) . '.xml';
        $handler = fopen(filename: $this->publicDir . 'sitemaps/' .  $fileName, mode: 'w+');
        $metadata = stream_get_meta_data($handler);
        $filename = $metadata['uri'];

        $entityManagerRegistery = $this->managerRegistry->getManagerForClass( $sitemap->entityClass);
        $repository = $entityManagerRegistery->getMetadataFactory();

        $entities = $entityManagerRegistery->getRepository($sitemap->entityClass)->findBy($sitemap->fetchCriteria);

        $urlGenerationAttribute = [];

        fwrite($handler, sprintf('<?xml version="1.0" encoding="UTF-8"?>%s<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">%s'.PHP_EOL, PHP_EOL, PHP_EOL));
        foreach ($entities as $entity) {
            foreach ($sitemap->urlGenerationAttributes as $key) {
                if (property_exists($entity, $key)) {
                    $method = 'get'.ucfirst($key);
                    if (method_exists($entity, $method)) {
                        $urlGenerationAttribute[$key] = $entity->$method();
                    }
                }
            }

            $modifiedDate = null;

            if ($sitemap->lastModifiedField) {
                if (property_exists($entity, $sitemap->lastModifiedField)) {
                    $method = 'get'.ucfirst($sitemap->lastModifiedField);
                    if (method_exists($entity, $method)) {
                        $date = $entity->$method();
                        if ($date instanceof \DateTime) {
                            $modifiedDate = $date->format('Y-m-d');
                        }
                        if ($date instanceof \DateTimeImmutable) {
                            $modifiedDate = $date::createFromFormat('Y-m-d', $date->format('Y-m-d'));
                            $modifiedDate = $modifiedDate->format('Y-m-d');
                        }
                    }
                    $modifiedDate = sprintf('<lastmod>%s</lastmod>', $modifiedDate);
                }
            }

            file_put_contents($filename, sprintf('<url>%s <loc>%s</loc>%s %s %s</url>%s',
                PHP_EOL,
                $this->urlGenerator->generate($route->getName(), $urlGenerationAttribute, UrlGeneratorInterface::ABSOLUTE_URL),
                PHP_EOL, $modifiedDate, PHP_EOL, PHP_EOL), FILE_APPEND);
        }
        file_put_contents($filename, '</urlset>', FILE_APPEND);
        fclose($handler);
        
//        $mainSitemapFile = fopen($this->publicDir, $mode)
    }

}