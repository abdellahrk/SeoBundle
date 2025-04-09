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

use Psr\Log\LoggerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Rami\SeoBundle\Schema\SchemaInterface;

final class SchemaOrgExtension extends AbstractExtension
{
    private SchemaInterface $schema;
    public function __construct(
         SchemaInterface $schema,
    ) {
        $this->schema = $schema;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('schema_org', [$this, 'renderSchemaOrg'], ['is_safe' => ['html']]),
        ];
    }

    public function renderSchemaOrg(): string|null
    {
        return $this->schema->getType() ? $this->schema->getType()->render() : null;
    }
}