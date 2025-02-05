<?php

namespace Infrastructure\Shared\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Image\Laravel\Facades\Image;

class Signature implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        try{
            $image = Image::read($value);
        }catch (\Exception $e){
            $fail('validation.signature')->translate();
        }
    }
}
