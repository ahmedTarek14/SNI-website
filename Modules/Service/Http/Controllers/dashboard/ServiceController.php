<?php

namespace Modules\Service\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Modules\Service\Http\Requests\ServiceRequest;
use Modules\Service\Models\Service;

class ServiceController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('translations')->orderByDesc('id')->get();

        return view('service::index', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        try {
            $service = Service::create([
                'logo' => $this->image_manipulate($request->file('logo'), 'services'),
                'slug' => $request->string('slug'),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $service->translateOrNew($locale);
                $translation->title = $request->string('title_' . $locale);
                $translation->subtitle = $request->input('subtitle_' . $locale);
                $translation->description = $request->input('description_' . $locale);
                $translation->save();
            }
            $url = route('admin.services.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('service::edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service)
    {
        try {
            $service->slug = $request->string('slug');

            if ($request->hasFile('logo')) {
                $this->image_delete($service->logo, 'services');
                $service->logo = $this->image_manipulate($request->file('logo'), 'services');
            }

            $service->save();

            foreach (config('translatable.locales') as $locale) {
                $translation = $service->translateOrNew($locale);
                $translation->title = $request->string('title_' . $locale);
                $translation->subtitle = $request->input('subtitle_' . $locale);
                $translation->description = $request->input('description_' . $locale);
                $translation->save();
            }
            $url = route('admin.services.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $this->image_delete($service->logo, 'services');
        $service->delete();

        return redirect()->back();
    }
}
