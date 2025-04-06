This Bundle supports
====================
-   [x] Meta Tags
-   [x] OpenGraph (Twitter Cards, Facebook, LinkedIn, Instagram, Discord and more)
-   [x] Structured Data (Schema)
-   [x] Sitemap Generation

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

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
composer require rami/seo-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Abdellahramadan\SeoBundle\SeoBundle::class => ['all' => true],
];
```

Full documentation at [Documentation](docs/index.md)