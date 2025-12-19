# Breadcrumbs

You can render breadcrumbs in your controller 

```php
    ...
    public function index(readcrumbManagerInterface $breadcrumbManager): Response
    {
        $breadcrumbManager
            ->addItem('home', 'https://exampl.com')
            ->addItem('blog', 'https://example.com/blog')
            ->addItem('Blog title')
            ...
    }
)
```

Than add the function where you want to render
```html
    {{ seo_breadcrumb() }}
```

It's using bootstrap by default but you can use the `getOptions()` to see the array keys to overwrite with `setOptions(array $options)'