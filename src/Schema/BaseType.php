<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema;

use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\Event;
use ReflectionClass;
use Stringable;

use function is_string;

class BaseType implements Stringable
{
    /**
     * @var array<string, mixed>
     */
    private array $properties = [];

    public function __toString(): string
    {
        return static::class;
    }

    public function getType(): string
    {
        return (new ReflectionClass($this))->getShortName();
    }

    /**
     * @return array<string, mixed>
     */
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

    public function id(string $value): static
    {
        $this->setProperty('id', $value);

        return $this;
    }

    public function alternateName(string $value): static
    {
        $this->setProperty('alternateName', $value);

        return $this;
    }

    public function url(string $value): self
    {
        $this->setProperty('url', $value);

        return $this;
    }

    public function inLanguage(string $isLanguage): static
    {
        $this->setProperty('inLanguage', $isLanguage);

        return $this;
    }

    public function setDescription(string $value): static
    {
        $this->setProperty('description', $value);

        return $this;
    }

    public function subjectOf(Event|CreativeWork|self $subjectOf): static
    {
        $this->setProperty('subjectOf', $this->parseChild($subjectOf));

        return $this;
    }

    public function render(): ?string
    {
        return '<script type="application/ld+json">'.
            json_encode($this->parse(), \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE | \JSON_PRETTY_PRINT).
           '</script>';
    }

    /**
     * @param string|array<int|string, mixed>|object|int|bool|float $value
     */
    protected function setProperty(string $name, string|array|object|int|bool|float $value): void
    {
        $this->properties[$name] = $value;
    }

    /**
     * @return array<string, mixed>
     */
    protected function parseChild(self $baseType): array
    {
        return [
            '@type' => $baseType->getType(), ] +
            $baseType->getProperties()
        ;
    }

    /**
     * @return array<string, mixed>
     */
    protected function parseChildWithId(self $baseType): array
    {
        $properties = $baseType->getProperties();

        // Replace "id" with "@id" if present and non-empty
        if (isset($properties['id']) && is_string($properties['id']) && '' !== $properties['id']) {
            $properties['@id'] = $properties['id'];
            unset($properties['id']);
        }

        return [
            '@type' => $baseType->getType(),
        ] + $properties;
    }

    /**
     * @param array<int, mixed> $children
     *
     * @return array<int, array<string, mixed>>
     */
    protected function parseArray(array $children): array
    {
        $properties = [];

        foreach ($children as $child) {
            if (!$child instanceof self) {
                continue;
            }

            $property = [
                '@type' => $child->getType(),
            ];

            $properties[] = array_merge($property, $child->getProperties());
        }

        return $properties;
    }

    /**
     * @return array<string, mixed>
     */
    private function parse(): array
    {
        return [
            '@context' => stripslashes('https://schema.org'),
            '@type' => $this->getType(), ] +
            $this->getProperties()
        ;
    }
}
