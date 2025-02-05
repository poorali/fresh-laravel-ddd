<?php

namespace Domain\Shared\Concerns;
trait HasError
{
    /**
     * This method gets a list of validation errors and convert it to key value pair with the first error
     * e.g: ["email" => ["invalid email"]] ====>  ["email" => "invalid email"]
     */
    public function toSingleError(array $errors, string $keyPrefix = ""): array
    {
        $formattedErrors = [];
        // Loop through each error message and create a key-value pair
        // with the field name and a user-friendly message.
        foreach ($errors as $field => $message) {
            $formattedErrors[$field] = $this->filterLabels($message[0]);
        }
        return $formattedErrors;
    }

    private function filterLabels(string $message): string
    {
        return str_replace(['_id',' id'], '', $message);
    }
}
