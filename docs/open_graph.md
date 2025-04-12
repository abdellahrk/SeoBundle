# Open Graph

#### Available interfaces and Twig functions

Interfaces available as Typehints
```php
-   OpenGraphManagerInterface
-   OGImageManagerInterface 
-   OGVideoManagerInterface
-   OGAudioManagerInterface
-   OGArticleManagerInterface
```

Twig functions to be included
```php 
-   {{ open_graph() }}
-   {{ og_image() }}
-   {{ og_video() }}
-   {{ og_audio() }}
-   {{ og_article() }}
```

### Example

### Add to template file
Add ```{{ open_graph() }}``` to the base template or any page where the meta information will be injected

You can define some defaults values in the `config/packages/open_graph.yaml` like:
```yaml
# config/packages/seo.yaml
seo:
    open_graph:
          description: Default description for all pages
          title: Default title
          url: https://my-og.com
          sitename: Default website name
          type: Default type
```

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

#### You can add structured data
```php
$openGraph->addStructuredProperty('image', 'secure_url', 'https://mysite.com/test.jpg')
```
this will render

```html
<meta property="og:image:secure_url" content="https://mysite.com/test.jpg" />
```

### Add Twitter card

```php
$openGraph->addTwitterCardProperty('description', 'This is an example X(Twitter) Card
```
will render
```html
<meta name="twitter:description" content="This is an example X(Twitter) Card)" />
```

Structured Properties
===

Ability to add structured properties like articles, images, videos, music and more.

### Image
Typehint the ogImageInterface

```php
use Rami\SeoBundle\OpenGraph\OGImageManagerInterface;

class HomeController {
    public function index(OGImageManagerInterface $imageManager) {
        $imageManager
            ->setUrl('https://example.com/og.jpg')
            ->setType('image/jpeg')
            ->setAlt('some image')
    }
}
```

or via Twig

```php
    {{ og_image(url: '...', type: '...', alt: '...', width: '...', ...)}}
```

renders

```html
<meta property="og:image" content="https://example.com/ogp.jpg" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:alt" content="some image" />
```

### Video


### Audio

### Article

All follows the same format as Image.
