<?php

namespace Rami\SeoBundle\Schema\Traits;

trait LocalBusinessServiceTrait
{
//   public function currenciesAccepted(string $currenciesAccepted): static
//   {
//       $this->setProperty('currenciesAccepted', $currenciesAccepted);
//       return $this;
//   }

   public function openingHours(string $openingHours): static
   {
       $this->setProperty('openingHours', $openingHours);
       return $this;
   }

//   public function paymentAccepted(string $paymentAccepted): static
//   {
//       $this->setProperty('paymentAccepted', $paymentAccepted);
//       return $this;
//   }

   public function priceRange(string $priceRange): static
   {
       $this->setProperty('priceRange', $priceRange);
       return $this;
   }
}