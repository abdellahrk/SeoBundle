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

namespace Rami\SeoBundle\Sitemap\EventHandler;

use Rami\SeoBundle\Sitemap\Event\UpdateSitemapEvent;
use Rami\SeoBundle\Sitemap\Message\GenerateSitemapMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class UpdateSitemapEventListener
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
    ) {
    }

    public function __invoke(UpdateSitemapEvent $updateSitemapEvent): void
    {
        $this->messageBus->dispatch(new GenerateSitemapMessage());
    }
}
