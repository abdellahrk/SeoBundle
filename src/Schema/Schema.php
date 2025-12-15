<?php

namespace Rami\SeoBundle\Schema;

use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article\SocialMediaPosting;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article\SocialMediaPosting\BlogPosting;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Blog;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Course;
use Rami\SeoBundle\Schema\Thing\CreativeWork\EducationalOccupationalCredential;
use Rami\SeoBundle\Schema\Thing\CreativeWork\ImageObject;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Thesis;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\AboutPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\CollectionPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPage\ContactPage;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebPageElement;
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebSite;
use Rami\SeoBundle\Schema\Thing\CreativeWork\TextObject;
use Rami\SeoBundle\Schema\Thing\Action;
use Rami\SeoBundle\Schema\Thing\Intangible\BreadcrumbList;
use Rami\SeoBundle\Schema\Thing\Intangible\DefinedTerm;
use Rami\SeoBundle\Schema\Thing\Intangible\JobPosting;
use Rami\SeoBundle\Schema\Thing\Intangible\ListItem;
use Rami\SeoBundle\Schema\Thing\Intangible\Occupation;
use Rami\SeoBundle\Schema\Thing\Intangible\Specialty;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\MonetaryAmount;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\PropertyValue;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\SpeakableSpecification;
use Rami\SeoBundle\Schema\Thing\Organization\LocalBusiness;
use Rami\SeoBundle\Schema\Thing\Organization\LocalBusiness\Library;
use Rami\SeoBundle\Schema\Thing\Organization\LocalBusiness\RadioStation;
use Rami\SeoBundle\Schema\Thing\Organization\LocalBusiness\TravelAgency;
use Rami\SeoBundle\Schema\Thing\Place\AdministrativeArea\Country;
use Rami\SeoBundle\Schema\Intangible\Audience;
use Rami\SeoBundle\Schema\Intangible\Service;
use Rami\SeoBundle\Schema\Place\AdministrativeArea;
use Rami\SeoBundle\Schema\Thing\Event;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;
use Rami\SeoBundle\Schema\Thing\Place;

class Schema implements SchemaInterface
{
    private ?BaseType $baseType = null;

    public function __construct() {
        $this->baseType = new Thing();
    }
    public function getType(): BaseType|null
    {
        return $this->baseType ?? null;
    }

    /**
     * @param BaseType $type
     * @return void
     */
    public function render(BaseType $type): void
    {
        $this->baseType = $type;
    }

    public function thing(): Thing
    {
        return new Thing();
    }

    public function service(): Service
    {
        return new Service();
    }

    public function event(): Event
    {
        return new Event();
    }

    public function creativeWork(): CreativeWork
    {
        return new CreativeWork();
    }

    public function person(): Person
    {
        return new Person();
    }

    public function administrativeArea(): AdministrativeArea
    {
        return new AdministrativeArea();
    }

    public function postalAddress(): PostalAddress
    {
        return new PostalAddress();
    }

    public function audience(): Audience
    {
        return new Audience();
    }

    public function jobPosting(): JobPosting
    {
        return new JobPosting();
    }

    public function occupation(): Occupation
    {
        return new Occupation();
    }

    public function monetaryAmount(): MonetaryAmount
    {
        return new MonetaryAmount();
    }

    public function educationOccupationalCredential(): EducationalOccupationalCredential
    {
        return new EducationalOccupationalCredential();
    }

    public function definedTerm(): DefinedTerm
    {
        return new DefinedTerm();
    }

    public function country(): Country
    {
        return new Country();
    }

    public function place(): Place
    {
        return new Place();
    }

    public function localBusiness(): LocalBusiness
    {
        return new LocalBusiness();
    }

    public function library(): Library
    {
        return new Library();
    }

    public function radioStation(): RadioStation
    {
        return new RadioStation();
    }

    public function travelAgency(): TravelAgency
    {
        return new TravelAgency();
    }

    public function blog(): Blog
    {
        return new Blog();
    }

    public function course(): Course
    {
        return new Course();
    }

    public function website(): WebSite
    {
        return new WebSite();
    }

    public function thesis(): Thesis
    {
        return new Thesis();
    }

    public function organization(): Organization
    {
        return new Organization();
    }

    public function webPage(): WebPage
    {
        return new WebPage();
    }

    public function collectionPage(): CollectionPage
    {
        return new CollectionPage();
    }

    public function mediaGallery(): CollectionPage\MediaGallery
    {
        return new CollectionPage\MediaGallery();
    }

    public function aboutPage(): AboutPage
    {
        return new AboutPage();
    }

    public function faqPage(): WebPage\FAQPage
    {
        return new WebPage\FAQPage();
    }

    public function aboutPage(): AboutPage
    {
        return new AboutPage();
    }

    public function aboutPage(): AboutPage
    {
        return new AboutPage();
    }

    public function aboutPage(): AboutPage
    {
        return new AboutPage();
    }

    public function aboutPage(): AboutPage
    {
        return new AboutPage();
    }

    public function imageObject(): ImageObject
    {
        return new ImageObject();
    }

    public function webPageElement(): WebPageElement
    {
        return new WebPageElement();
    }

    public function breadcrumbList(): BreadcrumbList
    {
        return new BreadcrumbList();
    }

    public function listItem(): ListItem
    {
        return new ListItem();
    }

    public function speakableSpecification(): SpeakableSpecification
    {
        return new SpeakableSpecification();
    }

    public function specialty(): Specialty
    {
        return new Specialty();
    }

    public function article(): Article
    {
        return new Article();
    }

    public function contactPage(): ContactPage
    {
        return new ContactPage();
    }

    public function socialMediaPosting(): SocialMediaPosting
    {
        return new SocialMediaPosting();
    }

    public function blogPosting(): BlogPosting
    {
        return new BlogPosting();
    }

    public function propertyValue(): PropertyValue
    {
        return new PropertyValue();
    }

    public function action(): Action
    {
        return new Action();
    }

    public function textObject(): TextObject
    {
        return new TextObject();
    }

}