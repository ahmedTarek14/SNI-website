<?php

namespace Modules\Smart\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Modules\Smart\Http\Requests\SmartFeatureRequest;
use Modules\Smart\Models\SmartFeature;

class SmartFeatureController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $features = SmartFeature::with('translations')->orderByDesc('id')->get();

        return view('smart::feature.index', compact('features'));
    }

    public function store(SmartFeatureRequest $request)
    {
        try {
            $feature = SmartFeature::create([
                'logo' => $this->image_manipulate($request->file('logo'), 'smart-features'),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $feature->translateOrNew($locale);
                $translation->title = $request->string('title_' . $locale);
                $translation->subtitle = $request->input('subtitle_' . $locale);
                $translation->save();
            }
            $url = route('admin.smart.features.index');
            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function edit(SmartFeature $smartFeature)
    {
        return view('smart::feature.edit', compact('smartFeature'));
    }

    public function update(SmartFeatureRequest $request, SmartFeature $smartFeature)
    {
        try {
            if ($request->hasFile('logo')) {
                $this->image_delete($smartFeature->logo, 'smart-features');
                $smartFeature->logo = $this->image_manipulate($request->file('logo'), 'smart-features');
                $smartFeature->save();
            }

            foreach (config('translatable.locales') as $locale) {
                $translation = $smartFeature->translateOrNew($locale);
                $translation->title = $request->string('title_' . $locale);
                $translation->subtitle = $request->input('subtitle_' . $locale);
                $translation->save();
            }

            $url = route('admin.smart.features.index');
            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function destroy(SmartFeature $smartFeature)
    {
        $this->image_delete($smartFeature->logo, 'smart-features');
        $smartFeature->delete();

        return redirect()->back();
    }
}
