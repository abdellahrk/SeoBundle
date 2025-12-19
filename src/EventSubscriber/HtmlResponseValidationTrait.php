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

use Symfony\Component\HttpKernel\Event\ResponseEvent;

use function is_string;

trait HtmlResponseValidationTrait
{
    /**
     * Validates if the response should be processed for HTML content injection.
     *
     * Checks:
     * - Accept header contains 'text/html'
     * - Response body is not empty
     * - Is main request (not sub-request)
     * - Is not AJAX request
     *
     * @return string|null Returns the response body if valid, null otherwise
     */
    private function getProcessableHtmlBody(ResponseEvent $responseEvent): ?string
    {
        $response = $responseEvent->getResponse();
        $request = $responseEvent->getRequest();

        $acceptHeader = $request->headers->get('accept', '');
        if (!is_string($acceptHeader) || !str_contains($acceptHeader, 'text/html')) {
            return null;
        }

        $body = $response->getContent();
        if (false === $body) {
            return null;
        }

        if (!$responseEvent->isMainRequest() || $request->isXmlHttpRequest()) {
            return null;
        }

        return $body;
    }
}
