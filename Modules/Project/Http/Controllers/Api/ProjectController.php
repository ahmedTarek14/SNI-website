<?php

namespace Modules\Project\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Page\Http\Resources\BannerResource;
use Modules\Page\Http\Resources\SectionResource;
use Modules\Page\Models\Page;
use Modules\Project\Http\Resources\CategoryResource;
use Modules\Project\Http\Resources\ChallengeResource;
use Modules\Project\Http\Resources\ImpactNumberResource;
use Modules\Project\Http\Resources\ProjectResource;
use Modules\Project\Models\Category;
use Modules\Project\Models\Challenge;
use Modules\Project\Models\ImpactNumber;
use Modules\Project\Models\Project;
use Modules\Sni\Http\Resources\ReviewResource;
use Modules\Sni\Models\Review;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $page = Page::where('slug', 'projects')->with(['banners', 'sections'])->first();

            $banner = $page?->banners?->sortBy('created_at')->first();

            $sections = $page?->sections?->sortBy('created_at')->values() ?? collect();

            $categories = Category::has('projects')
                ->orderByDesc('id')
                ->get();

            $projects = Project::orderByDesc('id')->get();

            $challenges = Challenge::orderByDesc('id')->get();

            $impactNumber = ImpactNumber::first();

            $reviews = Review::orderByDesc('id')->get();


            $data = [
                'banner'                => $banner ? new BannerResource($banner) : null,
                'section0'              => $sections->get(0) ? new SectionResource($sections->get(0)) : null,
                'categories'          => CategoryResource::collection($categories)->response()->getData(true),
                'section1'              => $sections->get(1) ? new SectionResource($sections->get(1)) : null,
                'projects'              => ProjectResource::collection($projects)->response()->getData(true),
                'section2'              => $sections->get(2) ? new SectionResource($sections->get(2)) : null,
                'challenge'             => ChallengeResource::collection($challenges)->response()->getData(true),
                'section3'              => $sections->get(3) ? new SectionResource($sections->get(3)) : null,
                'impact_number'         => $impactNumber ? new ImpactNumberResource($impactNumber) : null,
                'section4'              => $sections->get(3) ? new SectionResource($sections->get(4)) : null,
                'reviews'               => ReviewResource::collection($reviews)->response()->getData(true),
            ];


            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}
