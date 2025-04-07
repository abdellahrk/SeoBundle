<?php

namespace Rami\SeoBundle\Sitemap;

use Doctrine\Persistence\ManagerRegistry;
use DOMDocument;
use DOMXPath;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

final class Sitemap implements SitemapInterface
{
    public function __construct(
        #[Autowire('%kernel.project_dir%/public/')] private string $publicDir,
        private UrlGeneratorInterface $urlGenerator,
        private RequestStack $requestStack,
        private ManagerRegistry $managerRegistry,
        private ParameterBagInterface $parameterBag,
        private LoggerInterface $logger,
        private RouterInterface $router,
    ) {}

    const SITEMAP_XML = 'sitemap.xml';

    /**
     * @return void
     * @throws \DOMException
     * @throws \ReflectionException
     */
    public function generateSitemap(): void
    {
        $defaultSitemap = new \DomDocument('1.0', 'UTF-8');
        $defaultSitemap->formatOutput = true;
        if (false === file_exists($this->publicDir . 'sitemaps')) mkdir($this->publicDir . 'sitemaps');

//        $this->createSitemapFile($this->publicDir.'sitemaps/default', 'urlset');


        $routes = $this->router->getRouteCollection();
        $filename = $this->publicDir.'sitemaps/default.xml';

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
                        if ($instance instanceof Route) {
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
        $rootElement = $defaultSitemap->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
        $defaultSitemap->appendChild($rootElement);

        foreach ($allRoutes as $route) {
            $locationElement = $defaultSitemap->createElement('loc', $this->urlGenerator->generate($route->getName(), [], UrlGeneratorInterface::ABSOLUTE_URL));
            $urlElement = $defaultSitemap->createElement('url');
            $urlElement->appendChild($locationElement);
            $rootElement->appendChild($urlElement);
            $defaultSitemap->appendChild($rootElement);
        }

        $defaultSitemap->save($this->publicDir.'sitemaps/default.xml');
        if (null !== $request) {
            $this->addXmlToSitemap( $request->getSchemeAndHttpHost() .'/sitemaps/'.basename($filename));
        }
    }


    /**
     * @param array<mixed> $attributes
     * @return void
     * @throws \DOMException
     */
    public function generateDynamicSitemap(array $attributes): void
    {
        $route = null;
        $sitemap = null;
        $request = $this->requestStack->getCurrentRequest();
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
        $fileName = $sitemap->fileName ?? strtolower(end($defaultFilename));

        $sitemapDom = new DOMDocument('1.0', 'UTF-8');
        $sitemapDom->formatOutput = true;

        $entityManagerRegistery = $this->managerRegistry->getManagerForClass($sitemap->entityClass);

        if (!$entityManagerRegistery) {
            return;
        }

        $rootElement = $sitemapDom->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
        $sitemapDom->appendChild($rootElement);
        $repository = $entityManagerRegistery->getMetadataFactory();

        $entities = $entityManagerRegistery->getRepository($sitemap->entityClass)->findBy($sitemap->fetchCriteria);

        $urlGenerationAttribute = [];
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
            $locationElement = $sitemapDom->createElement('loc', $this->urlGenerator->generate($route->getName(), $urlGenerationAttribute, UrlGeneratorInterface::ABSOLUTE_URL));
            $urlElement = $sitemapDom->createElement('url');
            $urlElement->appendChild($locationElement);
            if ($sitemap->lastModifiedField) {
                if (property_exists($entity, $sitemap->lastModifiedField)) {
                    $method = 'get'.ucfirst($sitemap->lastModifiedField);
                    if (method_exists($entity, $method)) {
                        $date = $entity->{$method}();
                        if ($date instanceof \DateTime) {
                            $modifiedDate = $date->format('Y-m-d');
                        }
                        if ($date instanceof \DateTimeImmutable) {
                            $modifiedDate = $date::createFromFormat('Y-m-d', $date->format('Y-m-d'));
                            $modifiedDate = $modifiedDate->format('Y-m-d');
                        }
                    }

                    if ($modifiedDate) {
                        $lastMod = $sitemapDom->createElement('lastmod', $modifiedDate);
                        $urlElement->appendChild($lastMod);
                    }
                }
            }

            $this->createSitemapFile($fileName, $urlElement->textContent);
            $rootElement->appendChild($urlElement);
        }
        $sitemapDom->save($this->publicDir.'sitemaps/'.$fileName.'.xml');

        if (null !== $request) {
            $this->addXmlToSitemap($request->getSchemeAndHttpHost(). '/sitemaps/'.$fileName .'.xml');
        }
    }

    private function addXmlToSitemap(string $xmlPath): void
    {
        if (!file_exists($this->publicDir . 'sitemap.xml')) {
            try {
                $sitemap = new \DomDocument('1.0', 'UTF-8');
                $sitemap->formatOutput = true;
                $ns = $sitemap->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'sitemapindex', ' ');
                $sitemap->appendChild($ns);
                $sitemap->save('sitemap.xml');
            } catch (\Exception $exception) {
                $this->logger->error($exception->getMessage());
            }
        }

        $sitemap = new DOMDocument();
        $sitemap->formatOutput = true;

        if (!file_exists($this->publicDir.'sitemap.xml')) {
            $this->createIndexSitemapFile();
        }

        $sitemap->load($this->publicDir . 'sitemap.xml');

        $root = $sitemap->getElementsByTagName('sitemapindex');

        $xpath = new DOMXPath($sitemap);
        $xpath->registerNamespace('sm', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $nodes = $xpath->query("//sm:sitemap/sm:loc[text()='$xmlPath']");

        $now = new \DateTimeImmutable();

        if ($nodes->length === 0) {
            $location = $sitemap->createElement(localName:  'loc', value: $xmlPath);
            $sitemapRoot = $sitemap->createElement(localName:  'sitemap');
            $root[0]->appendChild($sitemapRoot);
            $lastMod = $sitemap->createElement('lastmod',$now->format('Y-m-d'));
            $sitemapRoot->appendChild($location);
            $sitemapRoot->appendChild($lastMod);
        }

        foreach ($nodes as $node) {
            $sitemapNode = $node->parentNode;
            $locNode = $node->nextSibling;
            $lastmod = null;

            foreach ($sitemapNode->childNodes as $child) {
                if ($child->nodeType === XML_ELEMENT_NODE && $child->localName === 'lastmod') {
                    $lastmod = $child;
                    break;
                }
            }

            if ($lastmod) {
                $lastmod->nodeValue = $now->format('Y-m-d');
            } else {
                $lastmod = $sitemap->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'lastmod', $now->format('Y-m-d'));
                if ($locNode) {
                    $sitemapNode->appendChild($lastmod);
                } else {
                    $sitemapNode->appendChild($lastmod);
                }
            }
        }
        
        $sitemap->normalizeDocument();
        $sitemap->save('sitemap.xml');
    }

    private function createSitemapFile(string $filename, ?string $name = null, ?string $child = null): void
    {
        if (!file_exists($this->publicDir . $filename)) {
            try {
                $sitemap = new \DomDocument('1.0', 'UTF-8');
                $sitemap->formatOutput = true;
                $ns = $sitemap->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', $name, $child);
                $sitemap->appendChild($ns);
                $sitemap->save($filename.'.xml');
            } catch (\Exception $exception) {
                $this->logger->error($exception->getMessage());
            }
        }
    }

    private function createIndexSitemapFile(): void
    {
        if (!file_exists($this->publicDir . self::SITEMAP_XML)) {
            try {
                $sitemap = new \DomDocument('1.0', 'UTF-8');
                $sitemap->formatOutput = true;
                $ns = $sitemap->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'sitemapindex');
                $sitemap->appendChild($ns);
                $sitemap->save($this->publicDir.self::SITEMAP_XML);
            } catch (\Exception $exception) {
                $this->logger->error($exception->getMessage());
            }
        }
    }
}