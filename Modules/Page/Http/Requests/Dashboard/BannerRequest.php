<?php

namespace Modules\Page\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BannerRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'page_id' => 'required|exists:pages,id',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules['header_' . $locale] = 'required|string';
            $rules['subtitle_' . $locale] = 'required|string';
        }

        return $rules;
    }

    public function attributes()
    {
        $attrs = ['page_id' => 'Page'];
        foreach (config('translatable.locales') as $locale) {
            $attrs['header_' . $locale] = "Header (" . strtoupper($locale) . ")";
            $attrs['subtitle_' . $locale] = "Subtitle (" . strtoupper($locale) . ")";
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
