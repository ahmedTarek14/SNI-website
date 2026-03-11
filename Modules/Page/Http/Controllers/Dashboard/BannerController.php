<?php

namespace Modules\Page\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Page\Http\Requests\Dashboard\BannerRequest;
use Modules\Page\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $pages = \Modules\Page\Models\Page::all();
        return view('page::banner.index', compact('banners', 'pages'));
    }

    public function store(BannerRequest $request)
    {
        $banner = new Banner();
        $banner->page_id = $request->page_id;
        $banner->save();

        foreach (config('translatable.locales') as $locale) {
            $translation = $banner->translateOrNew($locale);
            $translation->header = $request->get('header_' . $locale);
            $translation->subtitle = $request->get('subtitle_' . $locale);
            $translation->save();
        }

        $url = route('admin.banners.index');
        return add_response($url);
    }

    public function edit(Banner $banner)
    {
        $pages = \Modules\Page\Models\Page::all();
        return view('page::banner.edit', compact('banner', 'pages'));
    }

    public function update(BannerRequest $request, Banner $banner)
    {
        $banner->page_id = $request->page_id;
        $banner->save();

        foreach (config('translatable.locales') as $locale) {
            $translation = $banner->translateOrNew($locale);
            $translation->header = $request->get('header_' . $locale);
            $translation->subtitle = $request->get('subtitle_' . $locale);
            $translation->save();
        }

        $url = route('admin.banners.index');
        return update_response($url);
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->back();
    }
}
