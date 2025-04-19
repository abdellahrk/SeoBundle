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

use Rami\SeoBundle\Seo\MetaPixel\MetaPixelInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MetaPixelInjectorSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private MetaPixelInterface $metaPixel
    )
    {
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $request = $event->getRequest();

        if (!str_contains($request->headers->get('accept', ''), 'text/html' )) return;

        $body = $response->getContent();

        if (!$event->isMainRequest() || $request->isXmlHttpRequest()) {
            return;
        }

        $headerContent = $this->metaPixel->renderPixel();

        if ($headerContent) {
            $body = str_replace('</head>', $headerContent . PHP_EOL . '</head>', $body);
        }

        $response->setContent($body);
    }
}