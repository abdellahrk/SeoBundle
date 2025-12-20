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

namespace Rami\SeoBundle\Test\Integration\Schema;

use PHPUnit\Framework\TestCase;
use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Intangible\Audience;
use Rami\SeoBundle\Schema\Intangible\ItemList;
use Rami\SeoBundle\Schema\Intangible\Offer;
use Rami\SeoBundle\Schema\Intangible\Service;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Place\AdministrativeArea;
use Rami\SeoBundle\Schema\Schema;
use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Thing\Action;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article\SocialMediaPosting;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Article\SocialMediaPosting\BlogPosting;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Blog;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Course;
use Rami\SeoBundle\Schema\Thing\CreativeWork\EducationalOccupationalCredential;
use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject;
use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject\ImageObject;
use Rami\SeoBundle\Schema\Thing\CreativeWork\MediaObject\TextObject;
use Rami\SeoBundle\Schema\Thing\CreativeWork\Thesis;
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
use Rami\SeoBundle\Schema\Thing\CreativeWork\WebSite;
use Rami\SeoBundle\Schema\Thing\Event;
use Rami\SeoBundle\Schema\Thing\Intangible\BreadcrumbList;
use Rami\SeoBundle\Schema\Thing\Intangible\DefinedTerm;
use Rami\SeoBundle\Schema\Thing\Intangible\JobPosting;
use Rami\SeoBundle\Schema\Thing\Intangible\ListItem;
use Rami\SeoBundle\Schema\Thing\Intangible\Occupation;
use Rami\SeoBundle\Schema\Thing\Intangible\Specialty;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\MonetaryAmount;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\PropertyValue;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\SpeakableSpecification;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Organization\LocalBusiness;
use Rami\SeoBundle\Schema\Thing\Organization\LocalBusiness\Library;
use Rami\SeoBundle\Schema\Thing\Organization\LocalBusiness\RadioStation;
use Rami\SeoBundle\Schema\Thing\Organization\LocalBusiness\TravelAgency;
use Rami\SeoBundle\Schema\Thing\Person;
use Rami\SeoBundle\Schema\Thing\Place;
use Rami\SeoBundle\Schema\Thing\Place\AdministrativeArea\Country;

final class SchemaTest extends TestCase
{
    private Schema $schema;

    protected function setUp(): void
    {
        parent::setUp();
        $this->schema = new Schema();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->schema);
    }

    public function testConstructorInitializesWithThingType(): void
    {
        $type = $this->schema->getType();
        $this->assertInstanceOf(BaseType::class, $type);
        $this->assertInstanceOf(Thing::class, $type);
    }

    public function testRenderSetsBaseType(): void
    {
        $person = new Person();
        $this->schema->render($person);

        $type = $this->schema->getType();
        $this->assertInstanceOf(Person::class, $type);
    }

    public function testThingMethodReturnsThingInstance(): void
    {
        $thing = $this->schema->thing();
        $this->assertInstanceOf(Thing::class, $thing);
    }

    public function testServiceMethodReturnsServiceInstance(): void
    {
        $service = $this->schema->service();
        $this->assertInstanceOf(Service::class, $service);
    }

    public function testEventMethodReturnsEventInstance(): void
    {
        $event = $this->schema->event();
        $this->assertInstanceOf(Event::class, $event);
    }

    public function testCreativeWorkMethodReturnsCreativeWorkInstance(): void
    {
        $creativeWork = $this->schema->creativeWork();
        $this->assertInstanceOf(CreativeWork::class, $creativeWork);
    }

    public function testPersonMethodReturnsPersonInstance(): void
    {
        $person = $this->schema->person();
        $this->assertInstanceOf(Person::class, $person);
    }

    public function testAdministrativeAreaMethodReturnsAdministrativeAreaInstance(): void
    {
        $administrativeArea = $this->schema->administrativeArea();
        $this->assertInstanceOf(AdministrativeArea::class, $administrativeArea);
    }

    public function testPostalAddressMethodReturnsPostalAddressInstance(): void
    {
        $postalAddress = $this->schema->postalAddress();
        $this->assertInstanceOf(PostalAddress::class, $postalAddress);
    }

    public function testAudienceMethodReturnsAudienceInstance(): void
    {
        $audience = $this->schema->audience();
        $this->assertInstanceOf(Audience::class, $audience);
    }

    public function testJobPostingMethodReturnsJobPostingInstance(): void
    {
        $jobPosting = $this->schema->jobPosting();
        $this->assertInstanceOf(JobPosting::class, $jobPosting);
    }

    public function testItemListMethodReturnsItemListInstance(): void
    {
        $itemList = $this->schema->itemList();
        $this->assertInstanceOf(ItemList::class, $itemList);
    }

    public function testOccupationMethodReturnsOccupationInstance(): void
    {
        $occupation = $this->schema->occupation();
        $this->assertInstanceOf(Occupation::class, $occupation);
    }

    public function testMonetaryAmountMethodReturnsMonetaryAmountInstance(): void
    {
        $monetaryAmount = $this->schema->monetaryAmount();
        $this->assertInstanceOf(MonetaryAmount::class, $monetaryAmount);
    }

    public function testEducationOccupationalCredentialMethodReturnsInstance(): void
    {
        $educationalOccupationalCredential = $this->schema->educationOccupationalCredential();
        $this->assertInstanceOf(EducationalOccupationalCredential::class, $educationalOccupationalCredential);
    }

    public function testDefinedTermMethodReturnsDefinedTermInstance(): void
    {
        $definedTerm = $this->schema->definedTerm();
        $this->assertInstanceOf(DefinedTerm::class, $definedTerm);
    }

    public function testCountryMethodReturnsCountryInstance(): void
    {
        $country = $this->schema->country();
        $this->assertInstanceOf(Country::class, $country);
    }

    public function testPlaceMethodReturnsPlaceInstance(): void
    {
        $place = $this->schema->place();
        $this->assertInstanceOf(Place::class, $place);
    }

    public function testLocalBusinessMethodReturnsLocalBusinessInstance(): void
    {
        $localBusiness = $this->schema->localBusiness();
        $this->assertInstanceOf(LocalBusiness::class, $localBusiness);
    }

    public function testLibraryMethodReturnsLibraryInstance(): void
    {
        $library = $this->schema->library();
        $this->assertInstanceOf(Library::class, $library);
    }

    public function testRadioStationMethodReturnsRadioStationInstance(): void
    {
        $radioStation = $this->schema->radioStation();
        $this->assertInstanceOf(RadioStation::class, $radioStation);
    }

    public function testTravelAgencyMethodReturnsTravelAgencyInstance(): void
    {
        $travelAgency = $this->schema->travelAgency();
        $this->assertInstanceOf(TravelAgency::class, $travelAgency);
    }

    public function testBlogMethodReturnsBlogInstance(): void
    {
        $blog = $this->schema->blog();
        $this->assertInstanceOf(Blog::class, $blog);
    }

    public function testCourseMethodReturnsCourseInstance(): void
    {
        $course = $this->schema->course();
        $this->assertInstanceOf(Course::class, $course);
    }

    public function testWebsiteMethodReturnsWebSiteInstance(): void
    {
        $website = $this->schema->website();
        $this->assertInstanceOf(WebSite::class, $website);
    }

    public function testThesisMethodReturnsThesisInstance(): void
    {
        $thesis = $this->schema->thesis();
        $this->assertInstanceOf(Thesis::class, $thesis);
    }

    public function testOrganizationMethodReturnsOrganizationInstance(): void
    {
        $organization = $this->schema->organization();
        $this->assertInstanceOf(Organization::class, $organization);
    }

    public function testWebPageMethodReturnsWebPageInstance(): void
    {
        $webPage = $this->schema->webPage();
        $this->assertInstanceOf(WebPage::class, $webPage);
    }

    public function testCollectionPageMethodReturnsCollectionPageInstance(): void
    {
        $collectionPage = $this->schema->collectionPage();
        $this->assertInstanceOf(CollectionPage::class, $collectionPage);
    }

    public function testMediaGalleryMethodReturnsMediaGalleryInstance(): void
    {
        $mediaGallery = $this->schema->mediaGallery();
        $this->assertInstanceOf(MediaGallery::class, $mediaGallery);
    }

    public function testImageGalleryMethodReturnsImageGalleryInstance(): void
    {
        $imageGallery = $this->schema->imageGallery();
        $this->assertInstanceOf(ImageGallery::class, $imageGallery);
    }

    public function testAboutPageMethodReturnsAboutPageInstance(): void
    {
        $aboutPage = $this->schema->aboutPage();
        $this->assertInstanceOf(AboutPage::class, $aboutPage);
    }

    public function testFaqPageMethodReturnsFAQPageInstance(): void
    {
        $faqPage = $this->schema->faqPage();
        $this->assertInstanceOf(FAQPage::class, $faqPage);
    }

    public function testItemPageMethodReturnsItemPageInstance(): void
    {
        $itemPage = $this->schema->itemPage();
        $this->assertInstanceOf(ItemPage::class, $itemPage);
    }

    public function testCheckoutPageMethodReturnsCheckoutPageInstance(): void
    {
        $checkoutPage = $this->schema->checkoutPage();
        $this->assertInstanceOf(CheckoutPage::class, $checkoutPage);
    }

    public function testProfilePageMethodReturnsProfilePageInstance(): void
    {
        $profilePage = $this->schema->profilePage();
        $this->assertInstanceOf(ProfilePage::class, $profilePage);
    }

    public function testSearchResultPageMethodReturnsSearchResultsPageInstance(): void
    {
        $searchResultsPage = $this->schema->searchResultPage();
        $this->assertInstanceOf(SearchResultsPage::class, $searchResultsPage);
    }

    public function testMediaObjectMethodReturnsMediaObjectInstance(): void
    {
        $mediaObject = $this->schema->mediaObject();
        $this->assertInstanceOf(MediaObject::class, $mediaObject);
    }

    public function testOfferMethodReturnsOfferInstance(): void
    {
        $offer = $this->schema->offer();
        $this->assertInstanceOf(Offer::class, $offer);
    }

    public function testImageObjectMethodReturnsImageObjectInstance(): void
    {
        $imageObject = $this->schema->imageObject();
        $this->assertInstanceOf(ImageObject::class, $imageObject);
    }

    public function testWebPageElementMethodReturnsWebPageElementInstance(): void
    {
        $webPageElement = $this->schema->webPageElement();
        $this->assertInstanceOf(WebPageElement::class, $webPageElement);
    }

    public function testBreadcrumbListMethodReturnsBreadcrumbListInstance(): void
    {
        $breadcrumbList = $this->schema->breadcrumbList();
        $this->assertInstanceOf(BreadcrumbList::class, $breadcrumbList);
    }

    public function testListItemMethodReturnsListItemInstance(): void
    {
        $listItem = $this->schema->listItem();
        $this->assertInstanceOf(ListItem::class, $listItem);
    }

    public function testSpeakableSpecificationMethodReturnsSpeakableSpecificationInstance(): void
    {
        $speakableSpecification = $this->schema->speakableSpecification();
        $this->assertInstanceOf(SpeakableSpecification::class, $speakableSpecification);
    }

    public function testSpecialtyMethodReturnsSpecialtyInstance(): void
    {
        $specialty = $this->schema->specialty();
        $this->assertInstanceOf(Specialty::class, $specialty);
    }

    public function testArticleMethodReturnsArticleInstance(): void
    {
        $article = $this->schema->article();
        $this->assertInstanceOf(Article::class, $article);
    }

    public function testContactPageMethodReturnsContactPageInstance(): void
    {
        $contactPage = $this->schema->contactPage();
        $this->assertInstanceOf(ContactPage::class, $contactPage);
    }

    public function testSocialMediaPostingMethodReturnsSocialMediaPostingInstance(): void
    {
        $socialMediaPosting = $this->schema->socialMediaPosting();
        $this->assertInstanceOf(SocialMediaPosting::class, $socialMediaPosting);
    }

    public function testBlogPostingMethodReturnsBlogPostingInstance(): void
    {
        $blogPosting = $this->schema->blogPosting();
        $this->assertInstanceOf(BlogPosting::class, $blogPosting);
    }

    public function testPropertyValueMethodReturnsPropertyValueInstance(): void
    {
        $propertyValue = $this->schema->propertyValue();
        $this->assertInstanceOf(PropertyValue::class, $propertyValue);
    }

    public function testActionMethodReturnsActionInstance(): void
    {
        $action = $this->schema->action();
        $this->assertInstanceOf(Action::class, $action);
    }

    public function testTextObjectMethodReturnsTextObjectInstance(): void
    {
        $textObject = $this->schema->textObject();
        $this->assertInstanceOf(TextObject::class, $textObject);
    }

    public function testGetTypeReturnsCurrentType(): void
    {
        $type = $this->schema->getType();
        $this->assertInstanceOf(BaseType::class, $type);
    }

    public function testMultipleFactoryMethodCalls(): void
    {
        $person1 = $this->schema->person();
        $person2 = $this->schema->person();

        $this->assertNotSame($person1, $person2);
        $this->assertInstanceOf($person1::class, $person2);
    }

    public function testRenderChangesBaseType(): void
    {
        $initialType = $this->schema->getType();

        $person = new Person();
        $this->schema->render($person);

        $newType = $this->schema->getType();

        $this->assertNotSame($initialType, $newType);
        $this->assertInstanceOf(Person::class, $newType);
    }
}
