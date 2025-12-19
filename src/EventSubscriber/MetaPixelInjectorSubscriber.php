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

use Rami\SeoBundle\Seo\MetaPixel\MetaPixelInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

readonly class MetaPixelInjectorSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly MetaPixelInterface $metaPixel
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    public function onKernelResponse(ResponseEvent $responseEvent): void
    {
        $response = $responseEvent->getResponse();
        $request = $responseEvent->getRequest();

        $acceptHeader = $request->headers->get('accept', '');
        if (!is_string($acceptHeader) || !str_contains($acceptHeader, 'text/html')) {
            return;
        }

        $body = $response->getContent();
        if (false === $body) {
            return;
        }

        if (!$responseEvent->isMainRequest() || $request->isXmlHttpRequest()) {
            return;
        }

        $headerContent = $this->metaPixel->renderPixel();

        if ('' !== $headerContent && '0' !== $headerContent) {
            $body = str_replace('</head>', $headerContent.\PHP_EOL.'</head>', $body);
        }

        $response->setContent($body);
    }
}
