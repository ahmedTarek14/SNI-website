<?php

namespace Modules\Service\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Service\Http\Requests\ServiceFeatureRequest;
use Modules\Service\Models\Service;
use Modules\Service\Models\ServiceFeature;

class ServiceFeatureController extends Controller
{
    public function index(Service $service)
    {
        $features = $service->features()->with('translations')->orderBy('sort_order')->get();

        return view('service::feature.index', compact('service', 'features'));
    }

    public function store(ServiceFeatureRequest $request, Service $service)
    {
        try {
            $feature = ServiceFeature::create([
                'service_id' => $service->id,
                'icon'       => $request->input('icon'),
                'sort_order' => $request->input('sort_order', 0),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $feature->translateOrNew($locale);
                $translation->title       = $request->string('title_' . $locale);
                $translation->description = $request->input('description_' . $locale);
                $translation->save();
            }

            $url = route('admin.service-features.index', ['service' => $service->id]);

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function edit(ServiceFeature $feature)
    {
        $service = Service::findOrFail($feature->service_id);

        return view('service::feature.edit', compact('feature', 'service'));
    }

    public function update(ServiceFeatureRequest $request, ServiceFeature $feature)
    {
        try {
            $feature->update([
                'icon'       => $request->input('icon'),
                'sort_order' => $request->input('sort_order', 0),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $feature->translateOrNew($locale);
                $translation->title       = $request->string('title_' . $locale);
                $translation->description = $request->input('description_' . $locale);
                $translation->save();
            }

            $url = route('admin.service-features.index', ['service' => $feature->service_id]);

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function destroy(ServiceFeature $feature)
    {
        $serviceId = $feature->service_id;
        $feature->delete();

        return redirect()->route('admin.service-features.index', ['service' => $serviceId]);
    }
}
