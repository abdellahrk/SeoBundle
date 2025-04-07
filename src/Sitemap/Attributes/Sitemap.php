<?php

namespace Rami\SeoBundle\Sitemap\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD|Attribute::TARGET_FUNCTION)]
class Sitemap
{
    /**
     * @param string|null $entityClass
     * @param array<mixed>|null $fetchCriteria
     * @param array<mixed>|null $urlGenerationAttributes
     * @param string|null $lastModifiedField
     * @param string|null $fileName
     */
    public function __construct(
        public ?string $entityClass = null,
        public ?array $fetchCriteria = [],
        public ?array $urlGenerationAttributes = [],
        public ?string $lastModifiedField = null,
        public ?string $fileName = null,
    ) {}
}