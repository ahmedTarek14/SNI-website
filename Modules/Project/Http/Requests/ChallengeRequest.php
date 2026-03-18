<?php

namespace Modules\Project\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChallengeRequest extends FormRequest
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
        $rules = [
            'image' => $this->isMethod('post') ? 'required|image|max:6144' : 'nullable|image|max:6144',
            'name' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules['title_' . $locale] = ['required', 'string', 'max:255'];
            $rules['challenge_' . $locale] = ['nullable', 'string'];
            $rules['solution_' . $locale] = ['nullable', 'string'];
            $rules['result_' . $locale] = ['nullable', 'string'];
            $rules['description_' . $locale] = ['nullable', 'string'];
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes()
    {
        $attrs = [
            'image' => 'Image',
            'name' => 'Name',
            'company' => 'Company',
        ];

        foreach (config('translatable.locales') as $locale) {
            $upper = strtoupper($locale);

            $attrs['title_' . $locale] = 'Title (' . $upper . ')';
            $attrs['challenge_' . $locale] = 'Challenge (' . $upper . ')';
            $attrs['solution_' . $locale] = 'Solution (' . $upper . ')';
            $attrs['result_' . $locale] = 'Result (' . $upper . ')';
            $attrs['description_' . $locale] = 'Description (' . $upper . ')';
        }

        return $attrs;
    }
}
