<?php

namespace Modules\Smart\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SmartFeatureRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'logo' => $this->isMethod('post') ? 'required|image|max:4096' : 'nullable|image|max:4096',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules['title_'.$locale] = 'required|string|max:255';
            $rules['subtitle_'.$locale] = 'nullable|string|max:255';
        }

        return $rules;
    }

    public function attributes()
    {
        $attrs = [
            'logo' => 'Logo',
        ];

        foreach (config('translatable.locales') as $locale) {
            $attrs['title_'.$locale] = 'Title ('.strtoupper($locale).')';
            $attrs['subtitle_'.$locale] = 'Subtitle ('.strtoupper($locale).')';
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
