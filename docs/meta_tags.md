# Meta Tags

##### Example
Type hint the `MetaTagsInterface` into a controller

```php
use Abdellahramadan\SeoBundle\Metas\MetaTagsInterface;


public function myController(MetaTagsInterface $metaTags): Response 
{
    $metaTags->setTitle('My Title')
        ->setDescription('This is the description of the page')
        ->setKeywords(['keywords', 'seo', 'meta'])
        ->setCanonical('https://canonical.com')
    ;
}
```

Add this `{{ meta_tags }}` to the head your Twig file (preferably the base template)
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
