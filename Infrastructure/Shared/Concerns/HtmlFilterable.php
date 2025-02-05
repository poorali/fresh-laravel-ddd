<?php
namespace Infrastructure\Shared\Concerns;

trait HtmlFilterable{
    public static function removeSepcials(string $html){
        $patterns = [
            '/\\\\/', // Remove backslashes
            '/\r?\n|\r/', // Remove newlines
            '/[\x00-\x1F\x7F]/', // Remove control characters
            '/\s+/', // Replace multiple spaces with a single space
            '/<!--.*?-->/', // Remove HTML comments
            '/\s*([\[\]$$$$\{\}\<\>\=])\s*/', // Remove spaces around brackets, braces, and operators
        ];

        $replacements = [
            '', // For backslashes
            ' ', // For newlines
            '', // For control characters
            ' ', // For multiple spaces
            '', // For HTML comments
            '$1', // For spaces around brackets, braces, and operators
        ];

        return preg_replace($patterns, $replacements, $html);
    }

    // Function to replace double quotes with single quotes, preserving HTML entities
    public static function replaceDoubleQuotesWithSingle($html) {
        return preg_replace_callback(
            '/"(?=[^<]*(?:>|$))/',
            function($matches) {
                // Check if the double quote is part of an HTML entity
                $prevFiveChars = substr($matches[0], -6, 5);
                return (preg_match('/&[^;]+$/', $prevFiveChars)) ? $matches[0] : "'";
            },
            $html
        );
    }
}
