<?php

namespace Modules\Faq\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Faq\Http\Requests\FaqRequest;
use Modules\Faq\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::with('translations')->orderByDesc('id')->get();

        return view('faq::index', compact('faqs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqRequest $request)
    {
        try {
            $faq = new Faq;
            $faq->save();

            foreach (config('translatable.locales') as $locale) {
                $translation = $faq->translateOrNew($locale);
                $translation->question = $request->string('question_' . $locale);
                $translation->answer = $request->string('answer_' . $locale);
                $translation->save();
            }

            $url = route('admin.faqs.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        return view('faq::edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        try {
            foreach (config('translatable.locales') as $locale) {
                $translation = $faq->translateOrNew($locale);
                $translation->question = $request->string('question_' . $locale);
                $translation->answer = $request->string('answer_' . $locale);
                $translation->save();
            }

            $url = route('admin.faqs.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();

            return redirect()->back();
        } catch (\Throwable $th) {
            return error_response();
        }
    }
}
