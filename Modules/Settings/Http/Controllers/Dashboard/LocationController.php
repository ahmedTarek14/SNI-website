<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Settings\Http\Requests\LocationRequest;
use Modules\Settings\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with('translations')->orderByDesc('id')->get();

        return view('settings::location.index', compact('locations'));
    }

    public function store(LocationRequest $request)
    {
        try {
            $location = Location::create([
                'lat' => $request->input('lat'),
                'lng' => $request->input('lng'),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $location->translateOrNew($locale);
                $translation->address = $request->string('address_' . $locale);
                $translation->save();
            }

            $url = route('admin.locations.index');
            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function edit(Location $location)
    {
        return view('settings::location.edit', compact('location'));
    }

    public function update(LocationRequest $request, Location $location)
    {
        try {
            $location->update([
                'lat' => $request->input('lat'),
                'lng' => $request->input('lng'),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $location->translateOrNew($locale);
                $translation->address = $request->string('address_' . $locale);
                $translation->save();
            }

            $url = route('admin.locations.index');
            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->back();
    }
}
