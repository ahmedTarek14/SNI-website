<?php

namespace Modules\SocialMedia\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Modules\SocialMedia\Http\Requests\Dashboard\SocialMediaRequest;
use Modules\SocialMedia\Models\SocialMedia;

class SocialMediaController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $links = SocialMedia::all()->sortByDesc('id');

        return view('socialmedia::social.index', ['links' => $links]);
    }

    /**
     * Store a newly created resource in storage.
     * @param SocialMediaRequest $request
     * @return Renderable
     */
    public function store(SocialMediaRequest $request)
    {
        try {
            SocialMedia::create([
                'platform' => $request->platform,
                'link' => $request->link,
                'logo' => $this->image_manipulate($request->logo, 'social-media', 32, 32)
            ]);

            $url = route('admin.links.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(SocialMedia $socialMedia)
    {
        return view('socialmedia::social.edit', ['socialMedia' => $socialMedia]);
    }

    /**
     * Update the specified resource in storage.
     * @param SocialMediaRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(SocialMediaRequest $request, SocialMedia $socialMedia)
    {
        try {
            $data = $request->all();

            if ($request->has('logo')) {
                $this->image_delete($socialMedia->logo, 'social-media');
                $data['logo'] = $this->image_manipulate($request->logo, 'social-media', 32, 32);
            }


            $socialMedia->update($data);

            $url = route('admin.links.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(SocialMedia $socialMedia)
    {
        try {
            $this->image_delete($socialMedia->logo, 'social-media');
            $socialMedia->delete();

            return redirect()->back();
        } catch (\Throwable $th) {
            return error_response();
        }
    }
}
