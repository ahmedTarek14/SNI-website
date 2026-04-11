<?php

namespace Modules\Sni\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Modules\Sni\Http\Requests\VendorRequest;
use Modules\Sni\Models\Client;

class ClientController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::orderByDesc('id')->get();

        return view('sni::client.index', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorRequest $request)
    {
        try {
            Client::create([
                'logo' => $this->image_manipulate($request->file('logo'), 'clients'),
                'name' => $request->input('name'),
            ]);

            $url = route('admin.clients.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('sni::client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorRequest $request, Client $client)
    {
        try {
            if ($request->hasFile('logo')) {
                $this->image_delete($client->logo, 'clients');
                $client->logo = $this->image_manipulate($request->file('logo'), 'clients');
            }

            $client->name = $request->input('name');
            $client->save();

            $url = route('admin.clients.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->image_delete($client->logo, 'clients');
        $client->delete();

        return redirect()->back();
    }
}
