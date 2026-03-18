<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Modules\Settings\Http\Requests\SettingRequest;
use Modules\Settings\Models\Setting;

class SettingsController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $settings = Setting::query()->orderByDesc('id')->get();

    //     return view('settings::setting.index', compact('settings'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(SettingRequest $request)
    // {
    //     try {
    //         Setting::create([
    //             'logo' => $request->hasFile('logo') ? $this->image_manipulate($request->file('logo'), 'settings') : null,
    //             'email' => $request->input('email'),
    //             'phone' => $request->input('phone'),
    //         ]);

    //         $url = route('admin.settings.index');
    //         return add_response($url);
    //     } catch (\Throwable $th) {
    //         return error_response();
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('settings::setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        try {
            $data = [
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ];

            if ($request->hasFile('logo')) {
                if ($setting->logo) {
                    $this->image_delete($setting->logo, 'settings');
                }
                $data['logo'] = $this->image_manipulate($request->file('logo'), 'settings');
            }

            $setting->update($data);

            $url = route('admin.settings.edit', ['setting' => $setting->id]);
            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Setting $setting)
    // {
    //     if ($setting->logo) {
    //         $this->image_delete($setting->logo, 'settings');
    //     }

    //     $setting->delete();

    //     return redirect()->back();
    // }
}
