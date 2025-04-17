This Bundle supports
====================
-   [x] Meta Tags
-   [x] OpenGraph (Twitter Cards, Facebook, LinkedIn, Instagram, Discord and more)
-   [x] Structured Data (Schema)
-   [x] Sitemap Generation
-   [x] Google Tag
-   [ ] Facebook Pixel
-   [ ] SEO Profiling [Dev mode]
-   [ ] Breadcrum Generation


Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
composer require rami/seo-bundle
```

This will enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Abdellahramadan\SeoBundle\SeoBundle::class => ['all' => true],
];
```

# Meta Tags

##### Example
Define Meta Tags in Two ways:

1.  Type hint the `MetaTagsInterface` into a controller

```php
use Abdellahramadan\SeoBundle\Metas\MetaTagsManagerInterface;


public function myController(MetaTagsManagerInterface $metaTags): Response 
{
    $metaTags->setTitle('My Title')
        ->setDescription('This is the description of the page')
        ->setKeywords(['keywords', 'seo', 'meta'])
        ->setCanonical('https://canonical.com')
    ;
}
```

2.  Directly in twig 
```php
{{ meta_tags(title: 'My Title', description: 'This is the description of the page' ...)}
```

Make sure you add this `{{ meta_tags }}` to the head your Twig file (preferably the base template)
```php
<head>
    {{ meta_tags() }}
</head>
```

This will render in the head the following

```html
<head>
    <title>My Title</title>
    <meta name="description" content="This is the description of the page'">
    <meta name="keywords" content="keywords, seo, meta">
    <link rel="canonical" href="https://canonical.com">
</head>
```

Open Graph
=

### Example

### Add to template file
Add ```{{ open_graph() }}``` to the base template or any page where the meta information will be injected

### Add meta inforation
In your controller, type-hint `OpenGraphInterface`

### Example
```php

use Abdellahramadan\OpenGraphBundle\OpenGraph\OpenGraphManagerInterface;

class HomeController extends AbstractController
{
    public function index(OpenGraphManagerInterface $openGraph): Response
    {
        $openGraph
            ->setTitle('My website')
            ->setDescription('Some descriptions ...')
            ->setSiteName('My Blog')
        ;
            ...
        return $this-render('index.html.twig');
    }
}
```
This will render
```html
<meta property="og:title" content="My website">
<meta property="og:description" content="Some descriptions ...">
<meta property="og:site_name" content="My Blog">
```
You can also leave out setting the properties in the controller and set directly in Twi
```php
{{ meta_tags(title: 'My website', siteName: 'My Blog') }}
```

full document at [Open Graph Docs](docs/open_graph.md)

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
Full Schema docs at [Schema Org Docs](docs/schema.md)

Sitemap Generation
==================

This package automates the generation of sitemaps.

### Usage

```php
    #[Sitemap()]
    #[Route('/', name: 'app_home')]
    public function index() {
        ...
    }

    #[Sitemap()]
    #[Route('/blog', name: 'blog')]
    public function blogIndex() {
        ...
    }
```
This will add the the url entries into `sitemaps/default.xml`
```xml 
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://mysite.com/blog</loc>
  </url>
  <url>
    <loc>https://mysite.com/</loc>
  </url>
</urlset>
```

Full Sitemap docs [Sitemap Docs](docs/sitemap.md)

Full documentation at [Documentation](docs/index.md)