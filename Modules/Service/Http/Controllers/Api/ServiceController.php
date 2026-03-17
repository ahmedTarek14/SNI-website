<?php

namespace Modules\Service\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Page\Http\Resources\BannerResource;
use Modules\Page\Http\Resources\SectionResource;
use Modules\Page\Models\Page;
use Modules\Project\Http\Resources\ChallengeResource;
use Modules\Project\Models\Challenge;
use Modules\Service\Http\Resources\ServiceResource;
use Modules\Service\Models\Service;
use Modules\Sni\Http\Resources\ReviewResource;
use Modules\Sni\Models\Review;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $page = Page::where('slug', 'services')->with(['banners', 'sections'])->first();

            $banner = $page?->banners?->sortBy('created_at')->first();

            $sections = $page?->sections?->sortBy('created_at')->values() ?? collect();

            $services = Service::orderByDesc('id')->get();

            $challenges = Challenge::orderByDesc('id')->take(3)->get();

            $reviews = Review::orderByDesc('id')->get();


            $data = [
                'banner'               => $banner ? new BannerResource($banner) : null,
                'section0'             => $sections->get(0) ? new SectionResource($sections->get(0)) : null,
                'services'             => ServiceResource::collection($services)->response()->getData(true),
                'section1'             => $sections->get(1) ? new SectionResource($sections->get(1)) : null,
                'section2'             => $sections->get(2) ? new SectionResource($sections->get(2)) : null,
                'challenge'            => ChallengeResource::collection($challenges)->response()->getData(true),
                'section3'             => $sections->get(3) ? new SectionResource($sections->get(3)) : null,
                'reviews'              => ReviewResource::collection($reviews)->response()->getData(true),
            ];


            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}
