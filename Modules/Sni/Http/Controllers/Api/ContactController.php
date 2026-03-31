<?php

namespace Modules\Sni\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Faq\Http\Resources\FaqResource;
use Modules\Faq\Models\Faq;
use Modules\Page\Http\Resources\BannerResource;
use Modules\Page\Http\Resources\SectionResource;
use Modules\Page\Models\Page;
use Modules\Settings\Models\Location;
use Modules\Settings\Models\Setting;
use Modules\Settings\Models\WorkHour;
use Modules\Sni\Http\Requests\ContactRequest;
use Modules\Sni\Http\Resources\ReviewResource;
use Modules\Sni\Http\Resources\SniContactResource;
use Modules\Sni\Http\Resources\WorkHourResource;
use Modules\Sni\Models\Message;
use Modules\Sni\Models\Review;

class ContactController extends Controller
{
    public function index()
    {
        try {
            $page = Page::where('slug', 'contact')->with(['banners', 'sections'])->first();

            $banner   = $page?->banners?->sortBy('created_at')->first();
            $sections = $page?->sections?->sortBy('id')->values() ?? collect();

            $faq       = Faq::with('translations')->orderByDesc('id')->get();
            $reviews   = Review::with('translations')->orderByDesc('id')->get();
            $locations = Location::with('translations')->orderByDesc('id')->get();
            $setting   = Setting::all()->first();
            $workHours = WorkHour::orderBy('id')->get();

            $data = [
                'banner'     => $banner ? new BannerResource($banner) : null,
                'section0'   => $sections->get(0) ? new SectionResource($sections->get(0)) : null,
                'contact'    => new SniContactResource([
                    'addresses' => $locations
                        ->map(static function (Location $location) {
                            return [
                                'address'   => $location->translateOrDefault(locale())?->address ?? null,
                                'latitude'  => $location->lat,
                                'longitude' => $location->lng,
                            ];
                        })
                        ->filter()
                        ->values()
                        ->all(),
                    'phones' => $setting?->phone ? [(string) $setting->phone] : [],
                    'emails' => $setting?->email ? [(string) $setting->email] : [],
                ]),
                'work_hours' => WorkHourResource::collection($workHours)->response()->getData(true),
                'section1'   => $sections->get(1) ? new SectionResource($sections->get(1)) : null,
                'faq'        => FaqResource::collection($faq)->response()->getData(true),
                'section2'   => $sections->get(2) ? new SectionResource($sections->get(2)) : null,
                'reviews'    => ReviewResource::collection($reviews)->response()->getData(true),
            ];

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error($th->getMessage());
        }
    }

    public function store(ContactRequest $request)
    {
        try {
            Message::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'company'    => $request->company,
                'service_id' => $request->service_id,
                'message'    => $request->message,
            ]);

            return api_response_success('yourMessageWasSent');
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}
