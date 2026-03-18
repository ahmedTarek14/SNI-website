<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WorkHourRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'is_off' => 'required|in:0,1',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules['day_' . $locale] = 'required|string|max:255';
        }

        return $rules;
    }

    public function attributes()
    {
        $attrs = [
            'open_time' => 'Open Time',
            'close_time' => 'Close Time',
            'is_off' => 'Off',
        ];

        foreach (config('translatable.locales') as $locale) {
            $attrs['day_' . $locale] = 'Day (' . strtoupper($locale) . ')';
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
