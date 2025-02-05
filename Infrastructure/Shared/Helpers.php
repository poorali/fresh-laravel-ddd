<?php
if (!function_exists('fix_json')) {
    function fix_json($jsonString)
    {
        // Attempt to decode the JSON directly
        $result = json_decode($jsonString, true);
        if ($result !== null) {
            // JSON is valid, return as is
            return $jsonString;
        }

        // Try to fix missing quotes around keys
        // Regex to match unquoted keys
        $pattern = '/(\s*)([a-zA-Z_][a-zA-Z0-9_]*)\s*:/';
        $replacement = '$1"$2":';
        $fixedJson = preg_replace($pattern, $replacement, $jsonString);

        // Decode the fixed JSON
        $result = json_decode($fixedJson, true);
        if ($result !== null) {
            // Fixed JSON is now valid
            return $fixedJson;
        }

        // If still invalid, try to fix nested structures
        // This is a more aggressive approach and may not cover all cases
        $patternNested = '/({|,)\s*([a-zA-Z_][a-zA-Z0-9_]*)\s*:/';
        $replacementNested = '$1 "$2":';
        $fixedJsonNested = preg_replace($patternNested, $replacementNested, $fixedJson);

        // Decode the doubly fixed JSON
        $result = json_decode($fixedJsonNested, true);
        if ($result !== null) {
            return $fixedJsonNested;
        }

        // If still invalid, return original or throw exception
        return null; // or throw new Exception("Unable to fix JSON")
    }
}
