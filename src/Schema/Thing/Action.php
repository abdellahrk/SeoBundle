<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing;

use DateTime;
use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Thing;

class Action extends Thing
{
    public function agent(Person|Organization $agent): static
    {
        $this->setProperty('agent', $this->parseChild($agent));

        return $this;
    }

    public function object(BaseType $baseType): static
    {
        $this->setProperty('object', $this->parseChild($baseType));

        return $this;
    }

    public function target(string|BaseType $target): static
    {
        if ($target instanceof BaseType) {
            $this->setProperty('target', $this->parseChild($target));
        } else {
            $this->setProperty('target', $target);
        }

        return $this;
    }

    public function result(BaseType $baseType): static
    {
        $this->setProperty('result', $this->parseChild($baseType));

        return $this;
    }

    public function startTime(DateTime $startTime): static
    {
        $this->setProperty('startTime', $startTime->format('Y-m-d\TH:i:s'));

        return $this;
    }

    public function endTime(DateTime $endTime): static
    {
        $this->setProperty('endTime', $endTime->format('Y-m-d\TH:i:s'));

        return $this;
    }

    public function actionStatus(string $status): static
    {
        $this->setProperty('actionStatus', $status);

        return $this;
    }
}
