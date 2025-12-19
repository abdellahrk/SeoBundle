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

namespace Rami\SeoBundle\Sitemap;

use DateTime;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use DOMDocument;
use DOMException;
use DOMXPath;
use Exception;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

use function count;
use function sprintf;

final readonly class Sitemap implements SitemapInterface
{
    public const SITEMAP_XML = 'sitemap.xml';

    public function __construct(
        #[Autowire('%kernel.project_dir%/public/')]
        private string $publicDir,
        private UrlGeneratorInterface $urlGenerator,
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry,
        private LoggerInterface $logger,
        private RouterInterface $router,
    ) {
    }

    /**
     * @throws DOMException
     * @throws ReflectionException
     */
    public function generateSitemap(?string $baseUrl = null): void
    {
        if (false === file_exists($this->publicDir.'sitemaps')) {
            mkdir($this->publicDir.'sitemaps');
        }

        if (!file_exists($this->publicDir.'sitemap.xml')) {
            $this->createIndexSitemapFile();
        }

        $routeCollection = $this->router->getRouteCollection();
        $allRoutes = [];

        foreach ($routeCollection as $name => $route) {
            if (str_starts_with($name, '_profiler')) {
                continue;
            }

            if (str_starts_with($name, '_preview_error')) {
                continue;
            }

            if (str_starts_with($name, '_wdt')) {
                continue;
            }

            if (str_starts_with($name, '_debug')) {
                continue;
            }

            $defaults = $route->getDefaults();
            $controllerValue = $defaults['_controller'] ?? null;
            if (!is_string($controllerValue) || $controllerValue === '') {
                continue;
            }
            $controller = explode(':', $controllerValue)[0];
            /** @var class-string $controller */
            $ref = new ReflectionClass($controller);
            foreach ($ref->getMethods() as $method) {
                $attributes = $method->getAttributes();
                $currentRoute = null;
                if (count($attributes) > 1) {
                    $sitemapAttribute = false;
                    $routerExists = false;

                    foreach ($attributes as $attribute) {
                        $instance = $attribute->newInstance();
                        if ($instance instanceof Attributes\Sitemap) {
                            $sitemapAttribute = true;
                            if (null !== $instance->entityClass) {
                                $this->generateDynamicSitemap($attributes, $baseUrl);
                                break;
                            }
                        }

                        if ($instance instanceof Route) {
                            $routerExists = true;
                            $currentRoute = $instance;
                        }
                    }

                    if (!$sitemapAttribute) {
                        continue;
                    }

                    if (!$routerExists) {
                        continue;
                    }

                    $allRoutes[] = $currentRoute;
                }
            }
        }

        $allRoutes = array_unique($allRoutes, \SORT_REGULAR);
        /** @var array<Route> $filteredRoutes */
        $filteredRoutes = array_filter($allRoutes, fn($route) => $route instanceof Route);
        $this->addRoutesToXml($filteredRoutes, $baseUrl);
    }

    /**
     * @throws DOMException
     */
    public function generateDynamicSitemap(array $attributes, ?string $baseUrl = null): void
    {
        $route = null;
        $sitemap = null;
        $request = $this->requestStack->getCurrentRequest();
        foreach ($attributes as $attribute) {
            if (!$attribute instanceof \ReflectionAttribute) {
                continue;
            }
            $instance = $attribute->newInstance();
            if ($instance instanceof Route) {
                $route = $instance;
            }

            if ($instance instanceof Attributes\Sitemap) {
                $sitemap = $instance;
            }
        }

        if (!$route instanceof Route) {
            return;
        }

        if (!$sitemap instanceof Attributes\Sitemap) {
            return;
        }

        $defaultFilename = explode('\\', (string) $sitemap->entityClass);
        $fileName = $sitemap->fileName ?? strtolower(end($defaultFilename));

        $domDocument = new DOMDocument('1.0', 'UTF-8');
        $domDocument->formatOutput = true;

        if (null === $sitemap->entityClass) {
            return;
        }

        /** @var class-string $entityClass */
        $entityClass = $sitemap->entityClass;
        $entityManagerRegistery = $this->managerRegistry->getManagerForClass($entityClass);

        if (!$entityManagerRegistery instanceof ObjectManager) {
            return;
        }

        $rootElement = $domDocument->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
        $domDocument->appendChild($rootElement);

        /** @var array<string, mixed> $criteria */
        $criteria = $sitemap->fetchCriteria ?? [];
        $entities = $entityManagerRegistery->getRepository($entityClass)->findBy($criteria);

        $urlGenerationAttribute = [];
        foreach ($entities as $entity) {
            if (!is_array($sitemap->urlGenerationAttributes)) {
                continue;
            }
            foreach ($sitemap->urlGenerationAttributes as $key) {
                if (!is_string($key)) {
                    continue;
                }
                if (property_exists($entity, $key)) {
                    $method = 'get'.ucfirst($key);
                    if (method_exists($entity, $method)) {
                        $urlGenerationAttribute[$key] = $entity->$method();
                    }
                }
            }

            $modifiedDate = null;
            $routeName = $route->getName();
            if (null === $routeName) {
                continue;
            }
            $locationElement = $domDocument->createElement('loc', $this->urlGenerator->generate($routeName, $urlGenerationAttribute, UrlGeneratorInterface::ABSOLUTE_URL));
            $urlElement = $domDocument->createElement('url');
            $urlElement->appendChild($locationElement);
            if ($sitemap->lastModifiedField && property_exists($entity, $sitemap->lastModifiedField)) {
                $method = 'get'.ucfirst($sitemap->lastModifiedField);
                if (method_exists($entity, $method)) {
                    $date = $entity->{$method}();
                    if ($date instanceof DateTime) {
                        $modifiedDate = $date->format('Y-m-d');
                    }

                    if ($date instanceof DateTimeImmutable) {
                        $modifiedDate = $date->format('Y-m-d');
                    }
                }

                if ($modifiedDate) {
                    $lastMod = $domDocument->createElement('lastmod', $modifiedDate);
                    $urlElement->appendChild($lastMod);
                }
            }

            $this->createSitemapFile($fileName, $urlElement->textContent);
            $rootElement->appendChild($urlElement);
        }

        $domDocument->save($this->publicDir.'sitemaps/'.$fileName.'.xml');

        if ($request instanceof Request) {
            $this->addXmlToSitemap($request->getSchemeAndHttpHost().'/sitemaps/'.$fileName.'.xml');
        } else {
            $this->addXmlToSitemap($baseUrl.sprintf('/sitemaps/%s.xml', $fileName));
        }
    }

    /**
     * @param array<Route> $routes
     *
     * @throws DOMException
     */
    private function addRoutesToXml(array $routes, ?string $baseUrl = null): void
    {
        $filename = $this->publicDir.'sitemaps/default.xml';
        $request = $this->requestStack->getCurrentRequest();
        $domDocument = new DOMDocument('1.0', 'UTF-8');
        $domDocument->formatOutput = true;

        $rootElement = $domDocument->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
        $domDocument->appendChild($rootElement);
        foreach ($routes as $route) {
            $routeName = $route->getName();
            if (null === $routeName) {
                continue;
            }

            $locationElement = $domDocument->createElement('loc', $this->urlGenerator->generate($routeName, [], UrlGeneratorInterface::ABSOLUTE_URL));
            $urlElement = $domDocument->createElement('url');
            $urlElement->appendChild($locationElement);
            $rootElement->appendChild($urlElement);
            $domDocument->appendChild($rootElement);
        }

        $domDocument->save($this->publicDir.'sitemaps/default.xml');
        if ($request instanceof Request) {
            $this->addXmlToSitemap($request->getSchemeAndHttpHost().'/sitemaps/'.basename($filename));
        } else {
            $this->addXmlToSitemap($baseUrl.'/sitemaps/'.basename($filename));
        }
    }

    private function addXmlToSitemap(string $xmlPath): void
    {
        $domDocument = new DOMDocument();
        $domDocument->formatOutput = true;

        $domDocument->load($this->publicDir.'sitemap.xml');

        $domNodeList = $domDocument->getElementsByTagName('sitemapindex');

        $domxPath = new DOMXPath($domDocument);
        $domxPath->registerNamespace('sm', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        $nodes = $domxPath->query(sprintf("//sm:sitemap/sm:loc[text()='%s']", $xmlPath));

        if (false === $nodes) {
            return;
        }

        $now = new DateTimeImmutable();

        if (0 === $nodes->length) {
            $location = $domDocument->createElement(localName: 'loc', value: $xmlPath);
            $sitemapRoot = $domDocument->createElement(localName: 'sitemap');
            $firstItem = $domNodeList->item(0);
            if (null === $firstItem) {
                return;
            }
            $firstItem->appendChild($sitemapRoot);
            $lastMod = $domDocument->createElement('lastmod', $now->format('Y-m-d'));
            $sitemapRoot->appendChild($location);
            $sitemapRoot->appendChild($lastMod);
            $nodes = $domxPath->query(sprintf("//sm:sitemap/sm:loc[text()='%s']", $xmlPath));
            if (false === $nodes) {
                return;
            }
        }

        foreach ($nodes as $node) {
            if (!$node instanceof \DOMElement) {
                continue;
            }
            $sitemapNode = $node->parentNode;
            if (null === $sitemapNode) {
                continue;
            }
            $lastmod = null;

            foreach ($sitemapNode->childNodes as $child) {
                if (\XML_ELEMENT_NODE === $child->nodeType && 'lastmod' === $child->localName) {
                    $lastmod = $child;
                    break;
                }
            }

            if ($lastmod) {
                $lastmod->nodeValue = $now->format('Y-m-d');
            } else {
                $lastmod = $domDocument->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'lastmod', $now->format('Y-m-d'));
                $sitemapNode->appendChild($lastmod);
            }
        }

        $domDocument->save($this->publicDir.'sitemap.xml');
    }

    private function createSitemapFile(string $filename, ?string $name = null): void
    {
        if (!file_exists($this->publicDir.$filename)) {
            try {
                $domDocument = new DOMDocument('1.0', 'UTF-8');
                $domDocument->formatOutput = true;
                $elementName = $name ?? 'urlset';
                $ns = $domDocument->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', $elementName);
                $domDocument->appendChild($ns);
                $domDocument->save($filename.'.xml');
            } catch (Exception $exception) {
                $this->logger->error($exception->getMessage());
            }
        }
    }

    private function createIndexSitemapFile(): void
    {
        if (!file_exists($this->publicDir.self::SITEMAP_XML)) {
            try {
                $domDocument = new DOMDocument('1.0', 'UTF-8');
                $domDocument->formatOutput = true;
                $ns = $domDocument->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'sitemapindex');
                $domDocument->appendChild($ns);
                $domDocument->save($this->publicDir.self::SITEMAP_XML);
            } catch (Exception $exception) {
                $this->logger->error($exception->getMessage());
            }
        }
    }
}
