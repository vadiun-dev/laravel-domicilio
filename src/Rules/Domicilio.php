<?php

namespace Hitocean\LaravelDomicilio\Rules;

use Illuminate\Contracts\Validation\Rule;

class Domicilio implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return strtoupper($value) === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute must be uppercase.';
    }
}
