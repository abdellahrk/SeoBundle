<?php

namespace Rami\SeoBundle\Schema;

use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\Event;
use AllowDynamicProperties;

class BaseType
{
     private array $properties = [];
    public function __toString(): string
    {
        return get_class($this);
    }

    public function getType(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }
    protected function setProperty(string $name, string|array|object $value): void
    {
        $this->properties[$name] = $value;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getProperty(string $name): mixed
    {
        return $this->properties[$name] ?? null;
    }

    public function name(string $value): static
    {
        $this->setProperty('name', $value);
        return $this;
    }

    public function alternateName(string $value): static
    {
        $this->setProperty('alternateName', $value);
        return $this;
    }

    public function url(string $value): BaseType
    {
        $this->setProperty('url', $value);
        return $this;
    }
    public function setDescription(string $value): static
    {
        $this->setProperty('description', $value);
        return $this;
    }

    public function subjectOf(Event|CreativeWork|BaseType $subjectOf): static
    {
        $this->setProperty('subjectOf', $this->parseChild($subjectOf));
        return $this;
    }

    public function render(): string|null
    {
        return '<script type="application/ld+json">'.
            json_encode($this->parse(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT).
           '</script>';
    }

    private function parse(): array
    {
        return [
            "@context" => stripslashes("https://schema.org"),
            "@type" =>  $this->getType(),]+
            $this->getProperties()
        ;
    }

    protected function parseChild(BaseType $child): array
    {
        $properties = get_class_vars($child);
        return [
                "@type" =>  $child->getType(),]+
            $child->getProperties()
            ;
    }

    protected function parseArray(array $children): array
    {
        $properties = [];
        foreach ($children as $key => $child) {
            if ($child instanceof BaseType) {

                $property[ "@type"] = $child->getType() ;
                $property = $property+$child->getProperties();
                $properties[$key] = $property;
            }
        }

        return $properties;
    }
}