<?php

namespace Modules\Smart\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Page\Http\Resources\BannerResource;
use Modules\Page\Http\Resources\SectionResource;
use Modules\Page\Models\Page;
use Modules\Smart\Http\Resources\SmartResource;
use Modules\Smart\Models\SmartBenefit;
use Modules\Smart\Models\SmartFeature;

class SmartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $page = Page::where('slug', 'smart')->with(['banners', 'sections'])->first();

            $banner = $page?->banners?->sortBy('created_at')->first();

            $sections = $page?->sections?->sortBy('created_at')->values() ?? collect();

            $smartFeatures = SmartFeature::orderByDesc('id')->get();

            $smartBenefits = SmartBenefit::orderByDesc('id')->get();

            $data = [
                'banner'               => $banner ? new BannerResource($banner) : null,
                'section0'             => $sections->get(0) ? new SectionResource($sections->get(0)) : null,
                'smart_home_features'  => SmartResource::collection($smartFeatures)->response()->getData(true),
                'section1'             => $sections->get(1) ? new SectionResource($sections->get(1)) : null,
                'section2'             => $sections->get(2) ? new SectionResource($sections->get(2)) : null,
                'section3'             => $sections->get(3) ? new SectionResource($sections->get(3)) : null,
                'smart_home_benefits'  => SmartResource::collection($smartBenefits)->response()->getData(true),
                'section4'             => $sections->get(4) ? new SectionResource($sections->get(4)) : null,
            ];


            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}
