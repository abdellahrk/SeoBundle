<?php
/*
 * Copyright (c) 2025.
 *
 * This file is part of the SEO Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */
namespace Rami\SeoBundle\GoogleTagManager;

class TagManager implements TagManagerInterface
{
    private ?string $gtmId = null;

    /**
     * @return void
     */
    public function enableGoogleTagManager(?string $gtmId): void
    {
        $this->gtmId = $gtmId;
    }


    /**
     * @return string
     */
    public function renderHeadTag(): string
    {
        if (!$this->gtmId) return '';

        return <<<HTML
            <!-- Google Tag Manager -->
            <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{$this->gtmId}');
            </script>
            <!-- End Google Tag Manager -->
           HTML;
    }

    public function renderBodyTag(): string
    {
        if (!$this->gtmId) return '';

        return <<<HTML
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={$this->gtmId}"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
            HTML;
    }
}