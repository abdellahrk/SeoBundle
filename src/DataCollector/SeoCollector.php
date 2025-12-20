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

namespace Rami\SeoBundle\DataCollector;

use Rami\SeoBundle\Metas\MetaTagsManagerInterface;
use Rami\SeoBundle\OpenGraph\OpenGraphManagerInterface;
use Symfony\Bundle\FrameworkBundle\DataCollector\AbstractDataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Throwable;

use function assert;
use function is_array;

class SeoCollector extends AbstractDataCollector
{
    public function __construct(
        private readonly MetaTagsManagerInterface $metaTagsManager,
        private readonly NormalizerInterface $normalizer,
        private readonly OpenGraphManagerInterface $openGraphManager,
    ) {
    }

    public static function getTemplate(): ?string
    {
        return 'templates/seo/data_collector.html.twig';
    }

    public function collect(Request $request, Response $response, ?Throwable $exception = null): void
    {
        $this->data['seo_metas'] = $this->normalizer->normalize(
            $this->metaTagsManager->getSeoMeta(),
            null,
            [
                'skip_null_values' => true,
                'enable_max_depth' => true,
            ]
        );

        $this->data['open_graph'] = $this->normalizer->normalize(
            $this->openGraphManager->getOpenGraph(),
            null,
            [
                'skip_null_values' => true,
                'enable_max_depth' => true,
            ]
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function getSeoMetas(): array
    {
        $data = $this->data['seo_metas'] ?? [];
        assert(is_array($data));

        /** @var array<string, mixed> $returnData */
        $returnData = $data;

        return $returnData;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOpenGraph(): array
    {
        $data = $this->data['open_graph'] ?? [];
        assert(is_array($data));

        /** @var array<string, mixed> $returnData */
        $returnData = $data;

        return $returnData;
    }

    public function reset(): void
    {
        $this->data = [];
    }
}
