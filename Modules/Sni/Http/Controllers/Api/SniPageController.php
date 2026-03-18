<?php

namespace Modules\Sni\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Page\Http\Resources\BannerResource;
use Modules\Page\Http\Resources\SectionResource;
use Modules\Page\Models\Page;
use Modules\Project\Http\Resources\ImpactNumberResource;
use Modules\Project\Models\ImpactNumber;
use Modules\Service\Http\Resources\ServiceResource;
use Modules\Service\Models\Service;
use Modules\Settings\Models\Location;
use Modules\Settings\Models\Setting;
use Modules\Sni\Http\Resources\AboutUsResource;
use Modules\Sni\Http\Resources\SniContactResource;
use Modules\Sni\Http\Resources\VendorResource;
use Modules\Sni\Models\About;
use Modules\Sni\Models\Vendor;

class SniPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {

        try {
            $page = Page::where('slug', 'home')->with(['banners', 'sections'])->first();

            $banner = $page?->banners?->sortBy('created_at')->first();

            $sections = $page?->sections?->sortBy('created_at')->values() ?? collect();

            $services = Service::orderByDesc('id')->get();

            $vendors = Vendor::orderByDesc('id')->get();

            $about = About::orderByDesc('id')->get();

            $locations = Location::orderByDesc('id')->get();

            $setting = Setting::all()->first();

            $impactNumber = ImpactNumber::first();

            // $payload = [
            //     'banner' => $banner,
            //     'sections' => [
            //         $sections[0] ?? null,
            //         $sections[1] ?? null,
            //         $sections[2] ?? null,
            //         $sections[3] ?? null,
            //     ],
            //     'services' => $services,
            //     'smart_features' => $smartFeatures,
            //     'about' => $about,
            //     'contact' => [
            //         'addresses' => $addresses,
            //         'phones' => $phones,
            //         'emails' => $emails,
            //     ],
            // ];

            // $resource = new SniPageResource($payload);

            // return api_response_success($resource->toArray(request()));
            $data = [
                'banner' => $banner ? new BannerResource($banner) : null,
                'section0' => $sections->get(0) ? new SectionResource($sections->get(0)) : null,
                'services' => ServiceResource::collection($services)->response()->getData(true),
                'section1' => $sections->get(1) ? new SectionResource($sections->get(1)) : null,
                'vendors' => VendorResource::collection($vendors)->response()->getData(true),
                'section2' => $sections->get(2) ? new SectionResource($sections->get(2)) : null,
                'impact_number' => $impactNumber ? new ImpactNumberResource($impactNumber) : null,
                'section3' => $sections->get(3) ? new SectionResource($sections->get(3)) : null,
                'about_us' => AboutUsResource::collection($about)->response()->getData(true),
                'section4' => $sections->get(4) ? new SectionResource($sections->get(4)) : null,
                'contact' => new SniContactResource([
                    'addresses' => $locations
                        ->map(static function (Location $location) {
                            return [
                                'address' => $location->translateOrDefault(locale())?->address ?? null,
                                'latitude' => $location->lat,
                                'longitude' => $location->lng,

                            ];
                        })
                        ->filter()
                        ->values()
                        ->all(),
                    'phones' => $setting?->phone ? [(string) $setting->phone] : [],
                    'emails' => $setting?->email ? [(string) $setting->email] : [],
                ]),
            ];

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}
