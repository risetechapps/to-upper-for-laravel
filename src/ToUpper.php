<?php

namespace RiseTechApps\ToUpper;

use Illuminate\Support\Arr;

class ToUpper
{
    public function __construct(private array $config = [])
    {
    }

    public function normalize(string $value, ?string $encoding = null, ?bool $trim = null): string
    {
        $encoding ??= $this->config('encoding', mb_internal_encoding());
        $trim ??= $this->config('trim', true);

        $normalized = mb_strtoupper($value, $encoding);

        return $trim ? trim($normalized) : $normalized;
    }

    public function config(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $this->config;
        }

        return Arr::get($this->config, $key, $default);
    }
}
