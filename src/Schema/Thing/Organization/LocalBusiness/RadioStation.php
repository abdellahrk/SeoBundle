<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Organization\LocalBusiness;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\LocalBusinessServiceTrait;
use Rami\SeoBundle\Schema\Traits\OrganizationTrait;

class RadioStation extends BaseType
{
    use LocalBusinessServiceTrait;
    use OrganizationTrait;
}
