<?php

namespace Infrastructure\Shared\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use DOMDocument;

class ValidHtml implements ValidationRule
{
    private $html5Tags = ['article', 'aside', 'audio', 'canvas', 'command', 'datalist', 'details', 'embed', 'figcaption', 'figure', 'footer', 'header', 'hgroup', 'keygen', 'mark', 'meter', 'nav', 'output', 'progress', 'rp', 'rt', 'ruby', 'section', 'source', 'summary', 'time', 'track', 'video', 'wbr', 'main'];

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
            $errors = libxml_get_errors();
            $filteredErrors = $this->filterHTML5Errors($errors);
            libxml_clear_errors();

            if (!empty($filteredErrors)) {
                throw new \Exception();
            }

            // Check if all content is properly wrapped in tags
            $body = $dom->getElementsByTagName('body')->item(0);
//            if(!$body){
//                throw new \Exception();
//            }
            if ($body) {
                $childNodes = $body->childNodes;
                foreach ($childNodes as $node) {
                    if ($node->nodeType === XML_TEXT_NODE && trim($node->nodeValue) !== '') {
                        throw new \Exception();
                    }
                }
            }


            preg_match_all('/<([a-zA-Z][a-zA-Z0-9]*)\b[^>]*>(.*?)<\/\1>/', $value, $matches);
            if (empty(array_filter($matches))) {
                throw new \Exception();
            }
        }catch (\Exception $e){
            $fail('validation.html')->translate();
        }
    }

    private function filterHTML5Errors(array $errors): array
    {
        return array_filter($errors, function($error) {
            if ($error->code === 801) {
                foreach ($this->html5Tags as $tag) {
                    if (stripos($error->message, "Tag $tag invalid") !== false) {
                        return false;
                    }
                }
            }
            return true;
        });
    }
}
