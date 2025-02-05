<?php

namespace App\Http\Requests\API\V1\User;

use Domain\Shared\Concerns\HasError;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Infrastructure\Shared\Responses\ApiResponse;

class UpdateAvatarRequest extends FormRequest
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
        return  [
            'image' => 'bail|required|file|extensions:jpg,jpeg,png|max:5000'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ApiResponse::send($this->toSingleError($validator->errors()->messages()), 'error'));
    }
}
