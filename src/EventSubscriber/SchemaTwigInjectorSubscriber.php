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

use function assert;
use function is_array;

readonly class SchemaTwigInjectorSubscriber implements EventSubscriberInterface
{
    use HtmlResponseValidationTrait;

    public function __construct(
        private SchemaInterface $schema,
        private ParameterBagInterface $parameterBag,
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

        $content = $this->schema->getType() instanceof BaseType ? $this->schema->getType()->render() : null;

        if (null === $content) {
            return;
        }

        $body = str_replace('</head>', $content.\PHP_EOL.'</head>', $body);

        $responseEvent->getResponse()->setContent($body);
    }
}
