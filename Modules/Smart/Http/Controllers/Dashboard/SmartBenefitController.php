<?php

namespace Modules\Smart\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Modules\Smart\Http\Requests\SmartBenefitRequest;
use Modules\Smart\Models\SmartBenefit;

class SmartBenefitController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $benefits = SmartBenefit::with('translations')->orderByDesc('id')->get();

        return view('smart::benefit.index', compact('benefits'));
    }

    public function store(SmartBenefitRequest $request)
    {
        try {
            $benefit = SmartBenefit::create([
                'logo' => $this->image_manipulate($request->file('logo'), 'smart-benefits'),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $benefit->translateOrNew($locale);
                $translation->title = $request->string('title_' . $locale);
                $translation->subtitle = $request->input('subtitle_' . $locale);
                $translation->save();
            }

            $url = route('admin.smart.benefits.index');
            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function edit(SmartBenefit $smartBenefit)
    {
        return view('smart::benefit.edit', compact('smartBenefit'));
    }

    public function update(SmartBenefitRequest $request, SmartBenefit $smartBenefit)
    {
        try {
            if ($request->hasFile('logo')) {
                $this->image_delete($smartBenefit->logo, 'smart-benefits');
                $smartBenefit->logo = $this->image_manipulate($request->file('logo'), 'smart-benefits');
                $smartBenefit->save();
            }

            foreach (config('translatable.locales') as $locale) {
                $translation = $smartBenefit->translateOrNew($locale);
                $translation->title = $request->string('title_' . $locale);
                $translation->subtitle = $request->input('subtitle_' . $locale);
                $translation->save();
            }

            $url = route('admin.smart.benefits.index');
            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function destroy(SmartBenefit $smartBenefit)
    {
        $this->image_delete($smartBenefit->logo, 'smart-benefits');
        $smartBenefit->delete();

        return redirect()->back();
    }
}
