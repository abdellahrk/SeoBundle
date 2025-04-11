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

namespace Rami\SeoBundle\OpenGraph;

interface OGAudioManagerInterface
{
    public function getUrl(): string;

    public function setUrl(string $url): static;

    public function getSecureUrl(): string;

    public function setSecureUrl(string $secureUrl): static;

    public function getType(): string;

    public function setType(string $type): static;
}