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

### Command
There is a command available to generate sitemap
```makefile
seo:generate:sitemap
```

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
