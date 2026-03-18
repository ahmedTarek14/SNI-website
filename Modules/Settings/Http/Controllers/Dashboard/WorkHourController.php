<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Settings\Http\Requests\WorkHourRequest;
use Modules\Settings\Models\WorkHour;

class WorkHourController extends Controller
{
    public function index()
    {
        $workHours = WorkHour::with('translations')->orderByDesc('id')->get();

        return view('settings::work_hour.index', compact('workHours'));
    }

    public function store(WorkHourRequest $request)
    {
        try {
            $workHour = WorkHour::create([
                'open_time' => $request->input('open_time'),
                'close_time' => $request->input('close_time'),
                'is_off' => (bool) $request->input('is_off'),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $workHour->translateOrNew($locale);
                $translation->day = $request->string('day_' . $locale);
                $translation->save();
            }

            $url = route('admin.work-hours.index');
            return add_response($url);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return error_response();
        }
    }

    public function edit(WorkHour $workHour)
    {
        return view('settings::work_hour.edit', compact('workHour'));
    }

    public function update(WorkHourRequest $request, WorkHour $workHour)
    {
        try {
            $workHour->update([
                'open_time' => $request->input('open_time'),
                'close_time' => $request->input('close_time'),
                'is_off' => (bool) $request->input('is_off'),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $workHour->translateOrNew($locale);
                $translation->day = $request->string('day_' . $locale);
                $translation->save();
            }
            $url = route('admin.work-hours.index');
            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    // public function destroy(WorkHour $workHour)
    // {
    //     $workHour->delete();

    //     return redirect()->back();
    // }
}
