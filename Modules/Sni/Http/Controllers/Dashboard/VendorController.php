<?php

namespace Modules\Sni\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Modules\Sni\Http\Requests\VendorRequest;
use Modules\Sni\Models\Vendor;

class VendorController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::orderByDesc('id')->get();

        return view('sni::vendor.index', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorRequest $request)
    {
        try {
            Vendor::create([
                'logo' => $this->image_manipulate($request->file('logo'), 'vendors'),
                'name' => $request->input('name'),
            ]);

            $url = route('admin.vendors.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('sni::vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorRequest $request, Vendor $vendor)
    {
        try {
            if ($request->hasFile('logo')) {
                $this->image_delete($vendor->logo, 'vendors');
                $vendor->logo = $this->image_manipulate($request->file('logo'), 'vendors');
            }

            $vendor->name = $request->input('name');
            $vendor->save();

            $url = route('admin.vendors.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $this->image_delete($vendor->logo, 'vendors');
        $vendor->delete();

        return redirect()->back();
    }
}
