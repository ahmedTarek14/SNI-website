<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServiceProcessRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'num'        => 'nullable|string|max:4',
            'sort_order' => 'nullable|integer|min:0',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules['title_' . $locale]       = 'required|string|max:255';
            $rules['description_' . $locale] = 'nullable|string';
        }

        return $rules;
    }

    public function attributes()
    {
        $attrs = ['num' => 'Step Number', 'sort_order' => 'Sort Order'];

        foreach (config('translatable.locales') as $locale) {
            $attrs['title_' . $locale]       = 'Title (' . strtoupper($locale) . ')';
            $attrs['description_' . $locale] = 'Description (' . strtoupper($locale) . ')';
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
