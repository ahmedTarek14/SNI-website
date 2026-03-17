<?php

namespace Modules\Project\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Modules\Project\Http\Requests\ProjectRequest;
use Modules\Project\Models\Project;

class ProjectController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['translations', 'development'])->orderByDesc('id')->get();

        return view('project::index', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        try {
            $project = Project::create([
                'image' => $this->image_manipulate($request->file('image'), 'projects'),
                'clint' => $request->input('clint'),
                'date_at' => $request->input('date_at'),
                'development_id' => $request->input('development_id'),
            ]);

            foreach (config('translatable.locales') as $locale) {
                $translation = $project->translateOrNew($locale);
                $translation->name = $request->string('name_' . $locale);
                $translation->description = $request->input('description_' . $locale);
                $translation->save();
            }

            $url = route('admin.projects.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('project::edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = [
            'clint' => $request->input('clint'),
            'date_at' => $request->input('date_at'),
            'development_id' => $request->input('development_id'),
        ];

        if ($request->hasFile('image')) {
            $this->image_delete($project->image, 'projects');
            $data['image'] = $this->image_manipulate($request->file('image'), 'projects');
        }

        $project->update($data);

        foreach (config('translatable.locales') as $locale) {
            $translation = $project->translateOrNew($locale);
            $translation->name = $request->string('name_' . $locale);
            $translation->description = $request->input('description_' . $locale);
            $translation->save();
        }

        return redirect()->route('project.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->image_delete($project->image, 'projects');
        $project->delete();

        return redirect()->back();
    }
}
