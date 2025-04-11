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

namespace Rami\SeoBundle\DataCollector;

use Rami\SeoBundle\Metas\MetaTagsManagerInterface;
use Rami\SeoBundle\Metas\Model\SeoMeta;
use Symfony\Bundle\FrameworkBundle\DataCollector\AbstractDataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeoCollector extends AbstractDataCollector
{
    public function __construct(
        private MetaTagsManagerInterface $metaTagsManager,
    )
    {

    }

    public function collect(Request $request, Response $response, ?\Throwable $exception = null): void
    {
        $this->data['seoMeta'] = $this->metaTagsManager->getSeoMeta();
    }

    public function getSeoMeta(): SeoMeta
    {
        return $this->data['seoMeta'];
    }


    public function reset(): void
    {
        $this->data = [];
    }

}