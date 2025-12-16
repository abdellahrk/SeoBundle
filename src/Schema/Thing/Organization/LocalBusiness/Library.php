<?php

namespace Rami\SeoBundle\Schema\Thing\Organization\LocalBusiness;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\LocalBusinessServiceTrait;
use Rami\SeoBundle\Schema\Traits\OrganizationTrait;

class Library extends BaseType
{
    use OrganizationTrait;
    use LocalBusinessServiceTrait;
}