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
    use HtmlResponseValidationTrait;

    public function __construct(
        private MetaPixelInterface $metaPixel
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
        $body = $this->getProcessableHtmlBody($responseEvent);
        if (null === $body) {
            return;
        }

        $headerContent = $this->metaPixel->renderPixel();

        if ('' !== $headerContent && '0' !== $headerContent) {
            $body = str_replace('</head>', $headerContent.\PHP_EOL.'</head>', $body);
        }

        $responseEvent->getResponse()->setContent($body);
    }
}
