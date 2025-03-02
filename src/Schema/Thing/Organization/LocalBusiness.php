<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing\Organization;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Traits\LocalBusinessServiceTrait;
use Abdellahramadan\SeoBundle\Schema\Traits\OrganizationTrait;

class LocalBusiness extends BaseType
{
    use OrganizationTrait;
    use LocalBusinessServiceTrait;
}