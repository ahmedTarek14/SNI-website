<?php

namespace Modules\Page\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SectionRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'page_id' => 'required|exists:pages,id',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules['title_' . $locale] = 'required|string';
            $rules["subtitle_" . $locale] = 'nullable|string';
        }

        return $rules;
    }

    public function attributes()
    {
        $attrs = ['page_id' => 'Page'];
        foreach (config('translatable.locales') as $locale) {
            $attrs["title_" . $locale] = "Title (" . strtoupper($locale) . ")";
            $attrs["subtitle_" . $locale] = "Subtitle (" . strtoupper($locale) . ")";
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
