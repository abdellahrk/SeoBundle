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

namespace Rami\SeoBundle\Seo\MetaPixel;

class MetaPixel implements MetaPixelInterface
{
    private ?string $pixelId = null;
    /**
     * @param string $pixelId
     * @return void
     */
    public function enableMetaPixel(?string $pixelId): void
    {
        $this->pixelId = $pixelId;
    }

    /**
     * @return string
     */
    public function renderPixel(): string
    {
        if (null === $this->pixelId) {
            return '';
        }

        return <<<HTML
            <!-- Facebook Pixel Code -->
            <script>
              !function(f,b,e,v,n,t,s)
              {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
              n.callMethod.apply(n,arguments):n.queue.push(arguments)};
              if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
              n.queue=[];t=b.createElement(e);t.async=!0;
              t.src=v;s=b.getElementsByTagName(e)[0];
              s.parentNode.insertBefore(t,s)}(window, document,'script',
              'https://connect.facebook.net/en_US/fbevents.js');
              fbq('init', '{$this->pixelId}');
              fbq('track', 'PageView');
            </script>
            <noscript>
              <img height="1" width="1" style="display:none" 
                   src="https://www.facebook.com/tr?id={$this->pixelId}&ev=PageView&noscript=1"/>
            </noscript>
            <!-- End Facebook Pixel Code -->    
        HTML;

    }
}