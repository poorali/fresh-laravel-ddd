<?php

namespace App\Http\Requests\API\V1\User;

use Domain\Shared\Concerns\HasError;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Infrastructure\Shared\Responses\ApiResponse;

class AuthenticationRequest extends FormRequest
{
    use HasError;

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
        return [
            'firstname' => 'bail|required|string',
            'lastname' => 'bail|sometimes|string',
            'social_driver' => 'bail|required|in:' . implode(',', config('auth')['social_drivers']),
            'email' => [
                'bail',
                'required',
                'email'
            ],
            'avatar' => 'bail|sometimes|url'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ApiResponse::send($this->toSingleError($validator->errors()->messages()), 'error'));
    }
}
