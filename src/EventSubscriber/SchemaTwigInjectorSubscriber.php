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

namespace Rami\SeoBundle\EventSubscriber;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\SchemaInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Contracts\Cache\CacheInterface;

use function assert;
use function is_array;
use function is_float;
use function is_int;
use function is_string;
use function md5;
use function serialize;
use function sprintf;

readonly class SchemaTwigInjectorSubscriber implements EventSubscriberInterface
{
    use HtmlResponseValidationTrait;

    public function __construct(
        private SchemaInterface $schema,
        private ParameterBagInterface $parameterBag,
        private CacheInterface $cache,
    ) {
    }

    /**
     * @return array<string, string|array<int|string, string|int>>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => ['onKernelResponse'],
        ];
    }

    public function onKernelResponse(ResponseEvent $responseEvent): void
    {
        if (!$this->parameterBag->has('seo.schema')) {
            return;
        }

        $config = $this->parameterBag->get('seo.schema');
        assert(is_array($config));

        if (!$config['enabled']) {
            return;
        }

        $body = $this->getProcessableHtmlBody($responseEvent);
        if (null === $body) {
            return;
        }

        $type = $this->schema->getType();
        if (!$type instanceof BaseType) {
            return;
        }

        $route = $responseEvent->getRequest()->attributes->get('_route', 'unknown');
        assert(is_string($route));

        $properties = $type->getProperties();
        $cacheKey = sprintf(
            'schema_render_%s_%s',
            $route,
            md5(serialize($properties))
        );

        // default ttl 1 week
        $ttl = $config['cache_ttl'] ?? 604800;
        assert(is_int($ttl) || is_float($ttl));

        $content = $this->cache->get($cacheKey, fn (): string => $type->render() ?? '', (float) $ttl);

        if ('' === $content) {
            return;
        }

        $body = str_replace('</head>', $content.\PHP_EOL.'</head>', $body);

        $responseEvent->getResponse()->setContent($body);
    }
}
