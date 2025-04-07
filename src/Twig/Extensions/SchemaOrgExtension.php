<?php

namespace Rami\SeoBundle\Twig\Extensions;

use Psr\Log\LoggerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Rami\SeoBundle\Schema\SchemaInterface;

class SchemaOrgExtension extends AbstractExtension
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