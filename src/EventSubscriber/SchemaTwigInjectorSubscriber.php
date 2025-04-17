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

namespace Rami\SeoBundle\EventSubscriber;

use Rami\SeoBundle\Schema\SchemaInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class SchemaTwigInjectorSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private SchemaInterface $schema,
        private ParameterBagInterface $parameterBag,
    ){}

    /**
     * @return array[]|\array[][]|string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => ['onKernelResponse'],
        ];
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        if (!$this->parameterBag->has('seo.schema')) {
            return;
        }

        if (!$this->parameterBag->get('seo.schema')['enabled']) {
            return;
        }

        $response = $event->getResponse();
        $request = $event->getRequest();

        if (!str_contains($request->headers->get('accept', ''), 'text/html' )) return;

        $body = $response->getContent();

        if (!$event->isMainRequest() || $request->isXmlHttpRequest()) {
            return;
        }

        $content = $this->schema->getType() ? $this->schema->getType()->render() : null;

        if (null === $content) {
            return;
        }

        $body = str_replace('</head>', $content . PHP_EOL . '</head>', $body);

        $response->setContent($body);

    }
}