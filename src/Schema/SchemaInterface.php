<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema;

use Rami\SeoBundle\Schema\Intangible\Audience;
use Rami\SeoBundle\Schema\Intangible\ItemList;
use Rami\SeoBundle\Schema\Intangible\Offer;
use Rami\SeoBundle\Schema\Intangible\Service;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Place\AdministrativeArea;
use Rami\SeoBundle\Schema\Thing\Action;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article\SocialMediaPosting;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article\SocialMediaPosting\BlogPosting;
use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject;
use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject\ImageObject;
use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject\TextObject;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\AboutPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\CheckoutPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\CollectionPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\CollectionPage\MediaGallery;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\CollectionPage\MediaGallery\ImageGallery;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\ContactPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\FAQPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\ItemPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\ProfilePage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\SearchResultsPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPageElement;
use Rami\SeoBundle\Schema\Thing\Event;
use Rami\SeoBundle\Schema\Thing\Intangible\BreadcrumbList;
use Rami\SeoBundle\Schema\Thing\Intangible\ListItem;
use Rami\SeoBundle\Schema\Thing\Intangible\Specialty;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\PropertyValue;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\SpeakableSpecification;
use Rami\SeoBundle\Schema\Thing\Person;

interface SchemaInterface
{
    public function render(BaseType $baseType): void;

    public function thing(): Thing;

    public function service(): Service;

    public function creativeWork(): CreativeWork;

    public function event(): Event;

    public function person(): Person;

    public function administrativeArea(): AdministrativeArea;

    public function postalAddress(): PostalAddress;

    public function audience(): Audience;

    public function itemList(): ItemList;

    public function webPage(): WebPage;

    public function collectionPage(): CollectionPage;

    public function faqPage(): FAQPage;

    public function itemPage(): ItemPage;

    public function checkoutPage(): CheckoutPage;

    public function profilePage(): ProfilePage;

    public function searchResultPage(): SearchResultsPage;

    public function mediaGallery(): MediaGallery;

    public function imageGallery(): ImageGallery;

    public function aboutPage(): AboutPage;

    public function contactPage(): ContactPage;

    public function imageObject(): ImageObject;

    public function webPageElement(): WebPageElement;

    public function breadcrumbList(): BreadcrumbList;

    public function listItem(): ListItem;

    public function speakableSpecification(): SpeakableSpecification;

    public function specialty(): Specialty;

    public function article(): Article;

    public function socialMediaPosting(): SocialMediaPosting;

    public function blogPosting(): BlogPosting;

    public function propertyValue(): PropertyValue;

    public function offer(): Offer;

    public function action(): Action;

    public function textObject(): TextObject;

    public function mediaObject(): MediaObject;

    public function getType(): ?BaseType;
}
