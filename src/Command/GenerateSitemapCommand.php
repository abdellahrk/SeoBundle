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

use Psr\Log\LoggerInterface;
use Rami\SeoBundle\Sitemap\Message\GenerateSitemapMessage;
use Rami\SeoBundle\Sitemap\SitemapInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'seo:generate:sitemap',
    description: 'Generate sitemap',
    aliases: ['seo:sitemap:generate'],
    hidden: false,
)]
class GenerateSitemapCommand extends Command
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('baseUrl', InputArgument::OPTIONAL, 'The base url to generate sitemap');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->messageBus->dispatch(new GenerateSitemapMessage($input->getArgument('baseUrl')));
        $output->writeln("<info>Generating Sitemap</info>");
        return Command::SUCCESS;
    }
}
