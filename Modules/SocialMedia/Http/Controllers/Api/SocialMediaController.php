<?php

namespace Modules\SocialMedia\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\SocialMedia\Http\Resources\SocialMediaResource;
use Modules\SocialMedia\Models\SocialMedia;



class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $social_media = SocialMedia::all()->sortByDesc('id');
        try {
            return api_response_success(SocialMediaResource::collection($social_media)->response()->getData(true));
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}
