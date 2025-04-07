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

Then it'll add itself to `sitemap.xml`
```xml
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"> 
    <sitemap>
        <loc>https://mysite.com/sitemaps/default.xml</loc>
        <lastmod>2025-04-06</lastmod>
    </sitemap>
    ...
</sitemapindex>
```

Dynamic sitemap generation is also possible

```php
    #[Sitemap(
        entityClass: Blog::class,
        fetchCriteria: [], // DQL fetch criteria wip
        urlGenerationAttributes: ['id'],
        lastModifiedField: 'updatedAt', // to set the lastmod element
        fileName: null // If the filename is left empty, the entity name is used like blog.xml
    )]
    #[Route('/blog/{id}', name: 'app_show_blog')]
    public function show(Blog $blog): Response
    {
        ...
    }
```
This generates 
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://mysite.com/blog/1</loc>
    <lastmod>2024-11-01</lastmod>
  </url>
  <url>
    <loc>https://mysite.com/blog/2</loc>
  </url>
    ...
</urlset>
```

The `#[Sitemap()]` attribute takes a number of parameters.
-   entityClass: This is the object you want to fetch and populate
-   fetchCriteria: This is same as `findBy` when using Doctrine. It takes simple criterias for now like `['status' => 'publised']`
-   urlGenerationAttributes: This picks the params attributes like `id` or `slug` to aid in fetching
-   lastModifiedField: This field should exist in the `entityClass` like `updatedAt` field
-   fileName: Every dynamic sitemap is generated into its own field and then added to the `sitemap.xml`. Leaving the fileName empty will use the `entityClass` to generate such as `blog.xml`. Note: don't include the suffix `.xml` when passing the fileName.

and it'll update the `sitemap.xml` to

```xml
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"> 
    <sitemap>
        <loc>https://mysite.com/sitemaps/default.xml</loc>
        <lastmod>2025-04-06</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://mysite.com/sitemaps/blog.xml</loc>
        <lastmod>2025-04-06</lastmod>
    </sitemap>
    ...
</sitemapindex>
```

**This bundle uses the Symfony bus to generate the sitemap. Update your `messagenger.yaml`**
```php
...
Rami\SeoBundle\Sitemap\Message\GenerateSitemapMessage: [your_transport]
...
```

## Sitemap Generation

### Messenger
A message can also be dispatched to a bus
```php
use Rami\SeoBundle\Sitemap\Message\GenerateSitemapMessage;

$bug->dispatch(new GenerateSitemapMessage());
```

### Event
Dispatch an event
```php 
use Rami\SeoBundle\Sitemap\Event\UpdateSitemapEvent;

$eventDispatcher->dispatch(new UpdateSitemapEvent());
```

### Command
There is a command available to generate sitemap. This command does not dump the sitemaps into the `sitemap.xml` since `Request` is not available in the command space
```makefile
seo:generate:sitemap
```
