<?php

namespace Modules\Sni\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AboutRequest extends FormRequest
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
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules['title_' . $locale] = ['required', 'string', 'max:255'];
            $rules['description_' . $locale] = ['nullable', 'string'];
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes()
    {
        $attrs = [];

        foreach (config('translatable.locales') as $locale) {
            $upper = strtoupper($locale);

            $attrs['title_' . $locale] = 'Title (' . $upper . ')';
            $attrs['description_' . $locale] = 'Description (' . $upper . ')';
        }

        return $attrs;
    }
}
