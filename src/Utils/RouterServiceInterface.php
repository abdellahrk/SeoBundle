<?php

namespace Rami\SeoBundle\Utils;

use Symfony\Component\Routing\RouteCollection;

interface RouterServiceInterface
{
    public function getRoutes(): array|RouteCollection;
}