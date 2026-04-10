<?php

namespace Modules\Sni\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WhyItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->first(), 400));
    }

    public function rules()
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules['text_' . $locale] = 'required|string|max:500';
        }

        return $rules;
    }
}
