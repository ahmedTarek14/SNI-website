<?php

namespace Modules\Service\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Service\Http\Requests\ServiceFeatureRequest;
use Modules\Service\Models\Service;
use Modules\Service\Models\ServiceFeature;

class ServiceFeatureController extends Controller
{
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

            $url = route('admin.services.edit', ['service' => $service->id]);

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function destroy(ServiceFeature $feature)
    {
        $serviceId = $feature->service_id;
        $feature->delete();

        return redirect()->route('admin.services.edit', ['service' => $serviceId]);
    }
}
