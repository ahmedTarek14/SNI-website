<?php

namespace Modules\Development\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Development\Http\Resources\DevExpertiseResource;
use Modules\Development\Http\Resources\DevFeaturedProjectResource;
use Modules\Development\Http\Resources\DevGuaranteeResource;
use Modules\Development\Http\Resources\DevTechnologyResource;
use Modules\Development\Http\Resources\DevWhyItemResource;
use Modules\Development\Models\DevExpertise;
use Modules\Development\Models\DevFeaturedProject;
use Modules\Development\Models\DevGuarantee;
use Modules\Development\Models\DevTechnology;
use Modules\Development\Models\DevWhyItem;
use Modules\Faq\Http\Resources\FaqResource;
use Modules\Faq\Models\Faq;
use Modules\Sni\Http\Resources\ReviewResource;
use Modules\Sni\Models\Review;

class DevPageController extends Controller
{
    public function index()
    {
        try {
            $expertise       = DevExpertise::with('translations')->orderBy('id')->get();
            $technologies    = DevTechnology::orderBy('id')->get();
            $guarantees      = DevGuarantee::with('translations')->orderBy('id')->get();
            $featuredProjects= DevFeaturedProject::with('translations')->orderBy('id')->get();
            $whyItems        = DevWhyItem::with('translations')->orderBy('id')->get();
            $faqs            = Faq::with('translations')->orderBy('id')->get();
            $reviews         = Review::with('translations')->orderByDesc('id')->get();

            $data = [
                'expertise'         => DevExpertiseResource::collection($expertise)->response()->getData(true),
                'technologies'      => DevTechnologyResource::collection($technologies)->response()->getData(true),
                'guarantees'        => DevGuaranteeResource::collection($guarantees)->response()->getData(true),
                'featured_projects' => DevFeaturedProjectResource::collection($featuredProjects)->response()->getData(true),
                'why_items'         => DevWhyItemResource::collection($whyItems)->response()->getData(true),
                'faqs'              => FaqResource::collection($faqs)->response()->getData(true),
                'reviews'           => ReviewResource::collection($reviews)->response()->getData(true),
            ];

            return api_response_success($data);
        } catch (\Throwable $th) {
            \Illuminate\Support\Facades\Log::error('DevPageController error: ' . $th->getMessage());
            return api_response_error($th->getMessage());
        }
    }
}
