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

use Rami\SeoBundle\Seo\GoogleTagManager\TagManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

readonly class GoogleTagInjectorSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private TagManagerInterface $tagManager,
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

        $headerTag = $this->tagManager->renderHeadTag();
        $bodyTag = $this->tagManager->renderBodyTag();

        if ('' !== $headerTag && '0' !== $headerTag) {
            $body = str_replace('</head>', $headerTag.\PHP_EOL.'</head>', $body);
        }

        if ('' !== $bodyTag && '0' !== $bodyTag) {
            $body = str_replace('</body>', $bodyTag."\n</body>", $body);
        }

        $response->setContent($body);
    }
}
