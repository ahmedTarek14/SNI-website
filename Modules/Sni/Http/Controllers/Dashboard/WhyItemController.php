<?php

namespace Modules\Sni\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Sni\Http\Requests\WhyItemRequest;
use Modules\Sni\Models\WhyItem;

class WhyItemController extends Controller
{
    public function index()
    {
        $whyItems = WhyItem::with('translations')->orderByDesc('id')->get();

        return view('sni::why_item.index', compact('whyItems'));
    }

    public function store(WhyItemRequest $request)
    {
        try {
            $item = new WhyItem;
            $item->save();

            foreach (config('translatable.locales') as $locale) {
                $translation = $item->translateOrNew($locale);
                $translation->text = $request->string('text_' . $locale);
                $translation->save();
            }

            $url = route('admin.why-items.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function edit(WhyItem $whyItem)
    {
        return view('sni::why_item.edit', compact('whyItem'));
    }

    public function update(WhyItemRequest $request, WhyItem $whyItem)
    {
        try {
            foreach (config('translatable.locales') as $locale) {
                $translation = $whyItem->translateOrNew($locale);
                $translation->text = $request->string('text_' . $locale);
                $translation->save();
            }

            $url = route('admin.why-items.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function destroy(WhyItem $whyItem)
    {
        $whyItem->delete();

        return redirect()->back();
    }
}
