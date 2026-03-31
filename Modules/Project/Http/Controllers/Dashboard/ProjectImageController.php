<?php

namespace Modules\Project\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Modules\Project\Models\Project;
use Modules\Project\Models\ProjectImage;

class ProjectImageController extends Controller
{
    use ImageTrait;

    public function store(Project $project)
    {
        try {
            $images = request()->file('images', []);
            if (empty($images)) {
                return error_response();
            }

            $sortBase = $project->images()->max('sort_order') ?? -1;

            foreach ($images as $i => $file) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image'      => $this->image_manipulate($file, 'projects'),
                    'sort_order' => $sortBase + $i + 1,
                ]);
            }

            $url = route('admin.projects.edit', ['project' => $project->id]);

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function destroy(ProjectImage $projectImage)
    {
        $projectId = $projectImage->project_id;
        $this->image_delete($projectImage->image, 'projects');
        $projectImage->delete();

        return redirect()->route('admin.projects.edit', ['project' => $projectId]);
    }
}
