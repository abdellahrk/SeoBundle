Schema Org [Rich Result]
========================

### Usage 

```php
use Rami\SeoBundle\Schema\SchemaInterface;
use Symfony\Component\HttpFoundation\Response;

...
    #[Route('/', name: 'app_home')]
    public function index(SchemaInterface $schema): Response
    {
        $person = $schema
            ->person()
            ->name('Abdel Ramadan')
            ->email('abdellah@hey.cm')
            ->children([
                $schema->person()->name('Rami')->email('ramadanabdel24@gmail.com')->givenName('Ramadan'), 
                $schema->person()->name('Rami 3')->email('test@gmail.com')
            ]);
        $schema->render($person);
    }
```

enable the schema in the config:

```yaml
seo:
  schema:
    enabled: true
```

This is an example using the `Person` object which will render

```html
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Person",
    "name": "Abdel Ramadan",
    "email": "abdellah@hey.cm",
    "children": [
        {
            "@type": "Person",
            "name": "Rami",
            "email": "ramadanabdel24@gmail.com",
            "givenName": "Ramadan"
        },
        {
            "@type": "Person",
            "name": "Rami 3",
            "email": "test@gmail.com"
        }
    ]
}
</script>
```

### Currently Supported Schema Objects
- Thing
- Event
- Organization
- Person
- Place
- Product
- CreativeWork
- Airline
- LocalBusiness
- Library
- RadioStation
- TravelAgency
- IndividualProduct
- Audience
- Brand
- DefinedTerm
- Grant
- JobPosting
- Occupation
- VirtualLocation
- Blog
- Chapter
- Course
- EducationalOccupationCredential
- Thesis
- Website
- AboutPage
- BlogPosting
- AdministrativeArea
- Service