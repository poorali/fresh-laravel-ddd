<?php

namespace Infrastructure\Shared\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use DOMDocument;

class HtmlHasClass implements ValidationRule
{
    public function __construct(protected array $elements)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            $dom->loadHTML($value, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            foreach ($this->elements as $element){
                if(!$dom->getElementById($element)){
                    throw new \Exception();
                }
            }

        }catch (\Exception $e){
            $fail('validation.html')->translate();
        }
    }
}
