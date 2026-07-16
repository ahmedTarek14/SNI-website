<?php

namespace Modules\Service\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Service\Http\Requests\ServiceProcessRequest;
use Modules\Service\Models\Service;
use Modules\Service\Models\ServiceProcess;

class ServiceProcessController extends Controller
{
    public function index(Service $service)
    {
        $processes = $service->processes()->with('translations')->orderBy('sort_order')->get();

        return view('service::process.index', compact('service', 'processes'));
    }

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

            $url = route('admin.service-processes.index', ['service' => $service->id]);

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function edit(ServiceProcess $process)
    {
        $service = Service::findOrFail($process->service_id);

        return view('service::process.edit', compact('process', 'service'));
    }

    public function update(ServiceProcessRequest $request, ServiceProcess $process)
    {
        try {
            $process->update([
                'num'        => $request->input('num', '01'),
                'sort_order' => $request->input('sort_order', 0),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $process->translateOrNew($locale);
                $translation->title       = $request->string('title_' . $locale);
                $translation->description = $request->input('description_' . $locale);
                $translation->save();
            }

            $url = route('admin.service-processes.index', ['service' => $process->service_id]);

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function destroy(ServiceProcess $process)
    {
        $serviceId = $process->service_id;
        $process->delete();

        return redirect()->route('admin.service-processes.index', ['service' => $serviceId]);
    }
}
