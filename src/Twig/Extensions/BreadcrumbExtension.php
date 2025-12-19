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

namespace Rami\SeoBundle\Twig\Extensions;

use Rami\SeoBundle\Breadcrumb\BreadcrumbManagerInterface;
use Twig\Attribute\AsTwigFunction;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class BreadcrumbExtension
{
    public function __construct(
        private BreadcrumbManagerInterface $breadcrumbManager,
        private Environment $twigEnvironment
    ) {
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[AsTwigFunction('seo_breadcrumb', needsEnvironment: true, isSafe: ['html'])]
    public function renderBreadcrumb(): string
    {
        /** @var $item[] $items */
        $items = $this->breadcrumbManager->getItems();

        return $this->twigEnvironment->render('@Seo/breadcrumb.html.twig', [
            'breadcrumb' => $items,
            'options' => $this->breadcrumbManager->getOptions(),
        ]);
    }
}
