<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use DateTime;
use DateTimeInterface;
use Rami\SeoBundle\Schema\DataType\Text\Url;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Place;

class MediaObject extends CreativeWork
{
    public function bitrate(string $bitrate): static
    {
        $this->setProperty('bitrate', $bitrate);

        return $this;
    }

    public function contentSize(string $contentSize): static
    {
        $this->setProperty('contentSize', $contentSize);

        return $this;
    }

    public function contentUrl(string $contentUrl): static
    {
        $this->setProperty('contentUrl', $contentUrl);

        return $this;
    }

    public function duration(string $duration): static
    {
        $this->setProperty('duration', $duration);

        return $this;
    }

    public function embedUrl(Url $url): static
    {
        $this->setProperty('embedUrl', $url);

        return $this;
    }

    public function encodingFormat(string $encodingFormat): static
    {
        $this->setProperty('encodingFormat', $encodingFormat);

        return $this;
    }

    public function endTime(DateTimeInterface $endTime): static
    {
        $this->setProperty('endTime', $endTime->format(DateTime::ATOM));

        return $this;
    }

    public function playerType(string $playerType): static
    {
        $this->setProperty('playerType', $playerType);

        return $this;
    }

    public function productionCompany(Organization $organization): static
    {
        $this->setProperty('productionCompany', $this->parseChild($organization));

        return $this;
    }

    public function regionsAllowed(Place $place): static
    {
        $this->setProperty('regionsAllowed', $this->parseChild($place));

        return $this;
    }

    public function sha256(string $sha256): static
    {
        $this->setProperty('sha256', $sha256);

        return $this;
    }

    public function startTime(DateTimeInterface $startTime): static
    {
        $this->setProperty('startTime', $startTime->format(DateTime::ATOM));

        return $this;
    }

    public function uploadDate(DateTimeInterface $uploadDate): static
    {
        $this->setProperty('uploadDate', $uploadDate->format('Y-m-d'));

        return $this;
    }
}
