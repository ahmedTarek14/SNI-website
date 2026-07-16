<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Modules\Settings\Models\WorkHour;

class WorkHourRequest extends FormRequest
{
    public function rules()
    {
        $workHour = $this->route('workHour');

        return [
            'day_key' => [
                'required',
                Rule::in(array_keys(WorkHour::DAYS)),
                Rule::unique('work_hours', 'day_key')->ignore($workHour?->id),
            ],
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'is_off' => 'required|in:0,1',
        ];
    }

    public function attributes()
    {
        return [
            'day_key' => 'Day',
            'open_time' => 'Open Time',
            'close_time' => 'Close Time',
            'is_off' => 'Off',
        ];
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
