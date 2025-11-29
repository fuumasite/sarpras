<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // reCAPTCHA has been removed from the app. Keep this rule as a harmless noop
        // to avoid breaking any autoloaded references until composer autoload is regenerated.
        return;
    }
}