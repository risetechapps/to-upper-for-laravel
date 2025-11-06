<?php

namespace RiseTechApps\ToUpper\Traits;

use RiseTechApps\ToUpper\ToUpper;

trait HasToUpper
{
    public function setAttribute($key, $value)
    {
        if (is_string($value) && $this->shouldConvertToUpper($key)) {
            $value = $this->getToUpperService()->normalize(
                $value,
                $this->resolveEncoding(),
                $this->shouldTrim()
            );
        }

        return parent::setAttribute($key, $value);
    }

    private function shouldConvertToUpper($key): bool
    {
        $onlyUpper = $this->resolveOnlyUpperAttributes();
        if (!empty($onlyUpper)) {
            return in_array($key, $onlyUpper, true);
        }

        $noUpper = $this->resolveNoUpperAttributes();

        return !$this->isIgnoredAttribute($key)
            && !$this->isMorphAttribute($key)
            && !in_array($key, $noUpper, true);
    }

    protected function resolveOnlyUpperAttributes(): array
    {
        return $this->mergeConfiguredAttributes('only_upper');
    }

    protected function resolveNoUpperAttributes(): array
    {
        return $this->mergeConfiguredAttributes('no_upper');
    }

    protected function isIgnoredAttribute(string $key): bool
    {
        $ignore = $this->mergeConfiguredAttributes('ignore_attributes', 'ignore_upper');

        return in_array($key, $ignore, true);
    }

    protected function isMorphAttribute(string $key): bool
    {
        $suffixes = $this->mergeConfiguredAttributes('morph_suffixes');

        foreach ($suffixes as $suffix) {
            if ($suffix !== '' && str_contains($key, $suffix)) {
                return true;
            }
        }

        return false;
    }

    protected function shouldTrim(): bool
    {
        if (property_exists($this, 'uppercase_trim')) {
            return (bool) $this->uppercase_trim;
        }

        return (bool) $this->getToUpperService()->config('trim', true);
    }

    protected function resolveEncoding(): string
    {
        if (property_exists($this, 'uppercase_encoding') && is_string($this->uppercase_encoding)) {
            return $this->uppercase_encoding;
        }

        return (string) $this->getToUpperService()->config('encoding', mb_internal_encoding());
    }

    protected function mergeConfiguredAttributes(string $configKey, ?string $property = null): array
    {
        $property ??= $configKey;
        $configured = $this->normalizeArray($this->getToUpperService()->config($configKey, []));
        $modelValues = [];

        if (property_exists($this, $property)) {
            $modelValues = $this->normalizeArray($this->{$property});
        }

        return array_values(array_unique([...$configured, ...$modelValues]));
    }

    protected function normalizeArray(mixed $value): array
    {
        if (!is_array($value)) {
            return [];
        }

        return array_values(array_filter($value, fn ($item) => is_string($item) && $item !== ''));
    }

    protected function getToUpperService(): ToUpper
    {
        return app(ToUpper::class);
    }
}
