<?php

namespace Modules\Page\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Modules\Page\Http\Requests\Dashboard\PageRequest;
use Modules\Page\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $pages = Page::all()->sortByDesc('id');

        return view('page::page.index', ['pages' => $pages]);
    }

    /**
     * Store a newly created resource in storage.
     * @param PageRequest $request
     * @return Renderable
     */
    public function store(PageRequest $request)
    {
        try {
            Page::create([
                'template' => $request->template,
                'slug' => SlugService::createSlug(Page::class, 'slug', $request->template, ['unique' => true]),
            ]);

            $url = route('admin.pages.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Page $page
     * @return Renderable
     */
    public function edit(Page $page)
    {
        return view('page::page.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     * @param PageRequest $request
     * @param  Page $page
     * @return Renderable
     */
    public function update(PageRequest $request, Page $page)
    {
        try {
            $data = $request->all();

            $page->update($data);

            $url = route('admin.pages.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  Page $page
     * @return Renderable
     */
    public function destroy(Page $page)
    {
        try {
            $page->delete();

            return redirect()->back();
        } catch (\Throwable $th) {
            return error_response();
        }
    }
}
