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

use Rami\SeoBundle\OpenGraph\Model\Image;

interface OGImageManagerInterface
{
    public function getUrl(): string;

    public function setUrl(string $url): static;

    public function getSecureUrl(): string;

    public function setSecureUrl(string $secureUrl): static;

    public function getType(): string;

    public function setType(string $type): static;

    public function getWidth(): string;

    public function setWidth(string $width): static;

    public function getHeight(): string;

    public function setHeight(string $height): static;

    public function getAlt(): string;

    public function setAlt(string $alt): static;

    public function getImage(): Image;
}