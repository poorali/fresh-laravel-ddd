<?php

namespace App\Http\Requests\API\V1\User;

use Domain\Shared\Concerns\HasError;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Infrastructure\Shared\Concerns\HasEncodedId;
use Infrastructure\Shared\Responses\ApiResponse;

class UpdateProfileRequest extends FormRequest
{
    use HasError, HasEncodedId;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'firstname' => 'bail|required|string',
            'lastname' => 'bail|required|string',
            'timezone' => 'bail|required|in:' . implode(',', \DateTimeZone::listIdentifiers()),
            'summary' => 'bail|sometimes|max:255',
            'gender' => 'bail|sometimes|in:male,female,other',
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ApiResponse::send($this->toSingleError($validator->errors()->messages()), 'error'));
    }
}
