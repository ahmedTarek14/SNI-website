<?php

namespace Modules\Project\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImpactNumberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->first(), 400));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'satisfied_clients' => ['required', 'integer', 'min:0'],
            'completed_projects' => ['required', 'integer', 'min:0'],
            'years_of_experience' => ['required', 'integer', 'min:0'],
            'success_rate' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes()
    {
        return [
            'satisfied_clients' => 'Satisfied Clients',
            'completed_projects' => 'Completed Projects',
            'years_of_experience' => 'Years of Experience',
            'success_rate' => 'Success Rate',
        ];
    }
}
