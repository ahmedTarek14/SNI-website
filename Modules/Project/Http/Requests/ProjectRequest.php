<?php

namespace Modules\Project\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProjectRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'image' => $this->isMethod('post') ? 'required|image|max:6144' : 'nullable|image|max:6144',
            'clint' => 'nullable|string|max:255',
            'date_at' => 'nullable|date',
            'category_id' => 'required|integer',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules['name_' . $locale] = 'required|string|max:255';
            $rules['description_' . $locale] = 'nullable|string';
        }

        return $rules;
    }

    public function attributes()
    {
        $attrs = [
            'image' => 'Image',
            'clint' => 'Client',
            'date_at' => 'Date',
            'category_id' => 'Category',
        ];

        foreach (config('translatable.locales') as $locale) {
            $attrs['name_' . $locale] = 'Name (' . strtoupper($locale) . ')';
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
