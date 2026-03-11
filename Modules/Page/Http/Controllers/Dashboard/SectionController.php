<?php

namespace Modules\Page\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Page\Http\Requests\Dashboard\SectionRequest;
use Modules\Page\Models\Section;
use Modules\Page\Models\Page;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('page')->get();
        $pages = Page::all();
        return view('page::section.index', compact('sections', 'pages'));
    }

    public function store(SectionRequest $request)
    {
        $section = new Section();
        $section->page_id = $request->page_id;
        $section->save();

        foreach (config('translatable.locales') as $locale) {
            $translation = $section->translateOrNew($locale);
            $translation->title = $request->get('title_' . $locale);
            $translation->subtitle = $request->get('subtitle_' . $locale) ?? null;
            $translation->save();
        }

        $url = route('admin.sections.index');
        return add_response($url);
    }

    public function edit(Section $section)
    {
        $pages = Page::all();
        return view('page::section.edit', compact('section', 'pages'));
    }

    public function update(SectionRequest $request, Section $section)
    {
        $section->page_id = $request->page_id;
        $section->save();

        foreach (config('translatable.locales') as $locale) {
            $translation = $section->translateOrNew($locale);
            $translation->title = $request->get('title_' . $locale);
            $translation->subtitle = $request->get('subtitle_' . $locale) ?? null;
            $translation->save();
        }

        $url = route('admin.sections.index');
        return update_response($url);
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->back();
    }
}
