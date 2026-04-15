<?php

namespace Modules\Page\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Page\Http\Resources\BannerResource;
use Modules\Page\Models\Banner;

class BannerController extends Controller
{
    public function homeBanner()
    {
        try {
            $homeBanner = Banner::whereHas('page', function ($query) {
                $query->where('slug', 'home');
            })->first();

            return api_response_success(new BannerResource($homeBanner));
        } catch (\Throwable $th) {
            return api_response_error($th->getMessage());
        }
    }

    public function aboutBanner()
    {
        try {
            $aboutBanner = Banner::whereHas('page', function ($query) {
                $query->where('slug', 'about-sni');
            })->first();

            return api_response_success(new BannerResource($aboutBanner));
        } catch (\Throwable $th) {
            return api_response_error($th->getMessage());
        }
    }

    public function contactBanner()
    {
        try {
            $contactBanner = Banner::whereHas('page', function ($query) {
                $query->where('slug', 'contact');
            })->first();

            return api_response_success(new BannerResource($contactBanner));
        } catch (\Throwable $th) {
            return api_response_error($th->getMessage());
        }
    }

    public function servicesBanner()
    {
        try {
            $servicesBanner = Banner::whereHas('page', function ($query) {
                $query->where('slug', 'services');
            })->first();

            return api_response_success(new BannerResource($servicesBanner));
        } catch (\Throwable $th) {
            return api_response_error($th->getMessage());
        }
    }

    public function projectsBanner()
    {
        try {
            $projectsBanner = Banner::whereHas('page', function ($query) {
                $query->where('slug', 'projects');
            })->first();

            return api_response_success(new BannerResource($projectsBanner));
        } catch (\Throwable $th) {
            return api_response_error($th->getMessage());
        }
    }

    public function developmentBanner()
    {
        try {
            $developmentBanner = Banner::whereHas('page', function ($query) {
                $query->where('slug', 'development');
            })->first();

            return api_response_success(new BannerResource($developmentBanner));
        } catch (\Throwable $th) {
            return api_response_error($th->getMessage());
        }
    }
}