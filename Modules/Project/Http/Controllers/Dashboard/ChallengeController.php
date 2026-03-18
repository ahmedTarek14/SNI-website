<?php

namespace Modules\Project\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Modules\Project\Http\Requests\ChallengeRequest;
use Modules\Project\Models\Challenge;

class ChallengeController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $challenges = Challenge::with('translations')->orderByDesc('id')->get();

        return view('project::challenge.index', compact('challenges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChallengeRequest $request)
    {
        try {
            $challenge = Challenge::create([
                'image' => $this->image_manipulate($request->file('image'), 'challenges'),
                'name' => $request->input('name'),
                'company' => $request->input('company'),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $challenge->translateOrNew($locale);
                $translation->title = $request->string('title_' . $locale);
                $translation->challenge = $request->input('challenge_' . $locale);
                $translation->solution = $request->input('solution_' . $locale);
                $translation->result = $request->input('result_' . $locale);
                $translation->description = $request->input('description_' . $locale);
                $translation->save();
            }

            $url = route('admin.challenges.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Challenge $challenge)
    {
        return view('project::challenge.edit', compact('challenge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChallengeRequest $request, Challenge $challenge)
    {
        try {
            if ($request->hasFile('image')) {
                $this->image_delete($challenge->image, 'challenges');
                $challenge->image = $this->image_manipulate($request->file('image'), 'challenges');
            }

            $challenge->name = $request->input('name');
            $challenge->company = $request->input('company');
            $challenge->save();

            foreach (config('translatable.locales') as $locale) {
                $translation = $challenge->translateOrNew($locale);
                $translation->title = $request->string('title_' . $locale);
                $translation->challenge = $request->input('challenge_' . $locale);
                $translation->solution = $request->input('solution_' . $locale);
                $translation->result = $request->input('result_' . $locale);
                $translation->description = $request->input('description_' . $locale);
                $translation->save();
            }

            $url = route('admin.challenges.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challenge $challenge)
    {
        $this->image_delete($challenge->image, 'challenges');
        $challenge->delete();

        return redirect()->back();
    }
}
