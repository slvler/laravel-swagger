<?php

namespace App\Http\Requests;

use App\Enum\ActiveStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BlogStoreRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    public function authorize(): bool
    {
        return true;
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => $validator->errors()->first()
        ], 422));
    }
    public function rules(): array
    {
        return [
            'blog_category_id' => 'required|numeric|exists:blog_categories,id',
            'name' => 'required',
            'description' => 'required',
            'status' => ['required', Rule::in([ActiveStatus::ACTIVE->value, ActiveStatus::PASSIVE->value])],
        ];
    }
    public function messages()
    {
        return [
            'blog_category_id.required' => 'category_id is required',
            'name.required' => 'name is required',
            'description.required' => 'description is required',
            'status.required' => 'status is required',
        ];
    }
}
