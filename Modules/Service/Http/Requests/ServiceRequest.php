<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServiceRequest extends FormRequest
{
    public function rules()
    {
        $serviceId = $this->route('service')?->id;

        $rules = [
            'logo' => $this->isMethod('post') ? 'required|image|max:4096' : 'nullable|image|max:4096',
            'slug' => 'required|string|max:100|alpha_dash|unique:services,slug,' . $serviceId,
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules['title_'.$locale] = 'required|string|max:255';
            $rules['subtitle_'.$locale] = 'nullable|string|max:255';
            $rules['description_'.$locale] = 'nullable|string';
        }

        return $rules;
    }

    public function attributes()
    {
        $attrs = [
            'logo' => 'Logo',
            'slug' => 'Slug',
        ];

        foreach (config('translatable.locales') as $locale) {
            $attrs['title_'.$locale] = 'Title ('.strtoupper($locale).')';
            $attrs['subtitle_'.$locale] = 'Subtitle ('.strtoupper($locale).')';
            $attrs['description_'.$locale] = 'Description ('.strtoupper($locale).')';
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
