<?php

namespace Modules\Service\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Service\Http\Requests\ServiceProcessRequest;
use Modules\Service\Models\Service;
use Modules\Service\Models\ServiceProcess;

class ServiceProcessController extends Controller
{
    public function store(ServiceProcessRequest $request, Service $service)
    {
        try {
            $process = ServiceProcess::create([
                'service_id' => $service->id,
                'num'        => $request->input('num', '01'),
                'sort_order' => $request->input('sort_order', 0),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $process->translateOrNew($locale);
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

    public function destroy(ServiceProcess $process)
    {
        $serviceId = $process->service_id;
        $process->delete();

        return redirect()->route('admin.services.edit', ['service' => $serviceId]);
    }
}
