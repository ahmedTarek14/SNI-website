<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LocationRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'lat' => 'required|string|max:255',
            'lng' => 'required|string|max:255',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules['address_' . $locale] = 'required|string|max:255';
        }

        return $rules;
    }

    public function attributes()
    {
        $attrs = [
            'lat' => 'Lat',
            'lng' => 'Lng',
        ];

        foreach (config('translatable.locales') as $locale) {
            $attrs['address_' . $locale] = 'Address (' . strtoupper($locale) . ')';
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
