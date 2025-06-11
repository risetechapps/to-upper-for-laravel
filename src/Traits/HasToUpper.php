<?php

namespace RiseTechApps\ToUpper\Traits;

trait HasToUpper
{

    public function setAttribute($key, $value): void
    {
        parent::setAttribute($key, $value);

        if (is_string($value) && $this->shouldConvertToUpper($key)) {
            $this->attributes[$key] = trim(mb_strtoupper($value));
        }
    }

    private function shouldConvertToUpper($key): bool
    {
        $onlyUpper = property_exists($this, 'only_upper') && is_array($this->only_upper) ? $this->only_upper : [];
        if (!empty($onlyUpper)) {
            return in_array($key, $onlyUpper);
        }

        $noUpper = property_exists($this, 'no_upper') && is_array($this->no_upper) ? $this->no_upper : [];

        return !$this->isIgnore($key) && !$this->isMorph($key) && !in_array($key, $no_upper);
    }

    protected function isIgnore($key): bool
    {
        return in_array($key, [
            'id', 'password', 'password_confirm', 'remember_token',
            'slug', 'language', 'tenant', 'tenant_branch',
            'model_auth', 'model'
        ]);
    }

    protected function isMorph($key): bool
    {
        foreach ( ['_type', '_id'] as $morph) {
            if (str_contains($key, $morph)) {
                return true;
            }
        }
        return false;
    }
}
