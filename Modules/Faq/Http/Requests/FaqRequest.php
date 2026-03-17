<?php

namespace Modules\Faq\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FaqRequest extends FormRequest
{
    public function rules()
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules['question_'.$locale] = 'required|string|max:255';
            $rules['answer_'.$locale] = 'required|string';
        }

        return $rules;
    }

    public function attributes()
    {
        $attrs = [];

        foreach (config('translatable.locales') as $locale) {
            $attrs['question_'.$locale] = 'Question ('.strtoupper($locale).')';
            $attrs['answer_'.$locale] = 'Answer ('.strtoupper($locale).')';
        }

        return $attrs;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->first(), 400));
    }

    public function authorize()
    {
        return true;
    }
}
