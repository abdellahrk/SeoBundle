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

namespace Rami\SeoBundle\Twig\Extensions;

use Rami\SeoBundle\Breadcrumb\BreadcrumbManagerInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BreadcrumbExtension extends AbstractExtension
{
    public function __construct(
        private readonly BreadcrumbManagerInterface $breadcrumbManager,
        private readonly Environment $twig
    ) {
    }

    public function getFunctions(): array
    {
       return [
            new TwigFunction('seo_breadcrumb', [$this, 'renderBreadcrumb'], ['needs_environment' => true, 'is_safe' => ['html']]),
       ];
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function renderBreadcrumb(): string
    {
        /** @var $item[] $items */
        $items = $this->breadcrumbManager->getItems();

        return $this->twig->render('@Seo/breadcrumb.html.twig', [
            'breadcrumb' => $items,
            'options' => $this->breadcrumbManager->getOptions(),
        ]);
    }
}