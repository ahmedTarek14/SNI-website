<?php

namespace Modules\Sni\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Sni\Http\Requests\CoreValueRequest;
use Modules\Sni\Models\CoreValue;

class CoreValueController extends Controller
{
    public function index()
    {
        $coreValues = CoreValue::with('translations')->orderByDesc('id')->get();

        return view('sni::core_value.index', compact('coreValues'));
    }

    public function store(CoreValueRequest $request)
    {
        try {
            $coreValue = CoreValue::create([
                'icon' => $request->input('icon'),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $coreValue->translateOrNew($locale);
                $translation->title = $request->string('title_' . $locale);
                $translation->description = $request->input('description_' . $locale);
                $translation->save();
            }

            $url = route('admin.core-values.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function edit(CoreValue $coreValue)
    {
        return view('sni::core_value.edit', compact('coreValue'));
    }

    public function update(CoreValueRequest $request, CoreValue $coreValue)
    {
        try {
            $coreValue->icon = $request->input('icon');
            $coreValue->save();

            foreach (config('translatable.locales') as $locale) {
                $translation = $coreValue->translateOrNew($locale);
                $translation->title = $request->string('title_' . $locale);
                $translation->description = $request->input('description_' . $locale);
                $translation->save();
            }

            $url = route('admin.core-values.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function destroy(CoreValue $coreValue)
    {
        $coreValue->delete();

        return redirect()->back();
    }
}
