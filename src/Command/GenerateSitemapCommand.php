<?php

/*
 * Copyright (c) 2025.
 *
 * This file is part of the SEO Bundle project
 * @author Abdellah Ramadan
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Rami\SeoBundle\Command;

use Rami\SeoBundle\Sitemap\Message\GenerateSitemapMessage;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'seo:generate:sitemap',
    description: 'Generate sitemap',
    aliases: ['seo:sitemap:generate'],
    hidden: false,
)]
readonly class GenerateSitemapCommand
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {
    }

    public function __invoke(
        #[Argument(description: 'The base url to generate sitemap', name: 'Base Url')]
        string $baseUrl,
        SymfonyStyle $symfonyStyle
    ): int {
        $this->messageBus->dispatch(new GenerateSitemapMessage($baseUrl));
        $symfonyStyle->success('Generating Sitemap');

        return Command::SUCCESS;
    }
}
