<?php

namespace Modules\Service\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Page\Http\Resources\BannerResource;
use Modules\Page\Http\Resources\SectionResource;
use Modules\Page\Models\Page;
use Modules\Project\Http\Resources\ChallengeResource;
use Modules\Project\Models\Challenge;
use Modules\Service\Http\Resources\ServiceFeatureResource;
use Modules\Service\Http\Resources\ServiceProcessResource;
use Modules\Service\Http\Resources\ServiceResource;
use Modules\Service\Http\Resources\SingleServiceResource;
use Modules\Service\Models\Service;
use Modules\Service\Models\ServiceFeature;
use Modules\Service\Models\ServiceProcess;
use Modules\Sni\Http\Resources\ReviewResource;
use Modules\Sni\Models\Review;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $page = Page::where('slug', 'services')->with(['banners', 'sections'])->first();

            $banner = $page?->banners?->sortBy('created_at')->first();

            $sections = $page?->sections?->sortBy('id')->values() ?? collect();

            $services = Service::with('translations')->orderByDesc('id')->get();

            $challenges = Challenge::with('translations')->orderByDesc('id')->take(3)->get();

            $reviews = Review::with('translations')->orderByDesc('id')->get();

            $data = [
                'banner'    => $banner ? new BannerResource($banner) : null,
                'section0'  => $sections->get(0) ? new SectionResource($sections->get(0)) : null,
                'services'  => ServiceResource::collection($services)->response()->getData(true),
                'section1'  => $sections->get(1) ? new SectionResource($sections->get(1)) : null,
                'section2'  => $sections->get(2) ? new SectionResource($sections->get(2)) : null,
                'challenge' => ChallengeResource::collection($challenges)->response()->getData(true),
                'section3'  => $sections->get(3) ? new SectionResource($sections->get(3)) : null,
                'reviews'   => ReviewResource::collection($reviews)->response()->getData(true),
            ];

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    public function show($slug)
    {
        try {
            $service = Service::with('translations')
                ->where('slug', $slug)
                ->firstOrFail();

            $features = ServiceFeature::with('translations')
                ->where('service_id', $service->id)
                ->orderBy('sort_order')
                ->get();

            $processes = ServiceProcess::with('translations')
                ->where('service_id', $service->id)
                ->orderBy('sort_order')
                ->get();

            $data = (new ServiceResource($service))->toArray(request());
            $data['features'] = ServiceFeatureResource::collection($features)->resolve();
            $data['processes'] = ServiceProcessResource::collection($processes)->resolve();

            return api_response_success($data);
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('ServiceController::show: ' . $th->getMessage());
            return api_response_error($th->getMessage());
        }
    }

    public function all()
    {
        try {
            $services = Service::orderByDesc('id')->get();
            return api_response_success(SingleServiceResource::collection($services)->response()->getData(true));
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}
