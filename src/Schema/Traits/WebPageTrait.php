<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Traits;

use DateTime;
use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject\ImageObject;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPageElement;
use Rami\SeoBundle\Schema\Thing\Intangible\BreadcrumbList;
use Rami\SeoBundle\Schema\Thing\Intangible\Specialty;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\SpeakableSpecification;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;

use function is_array;

trait WebPageTrait
{
    public function breadcrumb(BreadcrumbList|string $breadcrumb): static
    {
        if ($breadcrumb instanceof BreadcrumbList) {
            $this->setProperty('breadcrumb', $this->parseChild($breadcrumb));
        } else {
            $this->setProperty('breadcrumb', $breadcrumb);
        }

        return $this;
    }

    public function lastReviewed(DateTime $date): static
    {
        $this->setProperty('lastReviewed', $date->format('Y-m-d'));

        return $this;
    }

    public function mainContentOfPage(WebPageElement $webPageElement): static
    {
        $this->setProperty('mainContentOfPage', $this->parseChild($webPageElement));

        return $this;
    }

    public function primaryImageOfPage(ImageObject $imageObject): static
    {
        $this->setProperty('primaryImageOfPage', $this->parseChild($imageObject));

        return $this;
    }

    public function relatedLink(string $url): static
    {
        $existingLinks = $this->getProperty('relatedLink') ?? [];
        if (!is_array($existingLinks)) {
            $existingLinks = [$existingLinks];
        }

        $existingLinks[] = $url;
        $this->setProperty('relatedLink', $existingLinks);

        return $this;
    }

    public function reviewedBy(Organization|Person $reviewer): static
    {
        $existingReviewers = $this->getProperty('reviewedBy') ?? [];
        if (!is_array($existingReviewers)) {
            $existingReviewers = [$existingReviewers];
        }

        $existingReviewers[] = $this->parseChild($reviewer);
        $this->setProperty('reviewedBy', $existingReviewers);

        return $this;
    }

    public function significantLink(string $url): static
    {
        $existingLinks = $this->getProperty('significantLink') ?? [];
        if (!is_array($existingLinks)) {
            $existingLinks = [$existingLinks];
        }

        $existingLinks[] = $url;
        $this->setProperty('significantLink', $existingLinks);

        return $this;
    }

    public function speakable(SpeakableSpecification|string $speakable): static
    {
        $existingSpeakable = $this->getProperty('speakable') ?? [];
        if (!is_array($existingSpeakable)) {
            $existingSpeakable = [$existingSpeakable];
        }

        if ($speakable instanceof SpeakableSpecification) {
            $existingSpeakable[] = $this->parseChild($speakable);
        } else {
            $existingSpeakable[] = $speakable;
        }

        $this->setProperty('speakable', $existingSpeakable);

        return $this;
    }

    public function specialty(Specialty $specialty): static
    {
        $this->setProperty('specialty', $this->parseChild($specialty));

        return $this;
    }
}
