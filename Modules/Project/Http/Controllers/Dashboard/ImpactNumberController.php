<?php

namespace Modules\Project\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Project\Http\Requests\ImpactNumberRequest;
use Modules\Project\Models\ImpactNumber;

class ImpactNumberController extends Controller
{
    /**
     * Show the form for editing the impact numbers.
     */
    public function edit()
    {
        $impactNumber = ImpactNumber::first();

        return view('project::impact_number.edit', compact('impactNumber'));
    }

    /**
     * Update the impact numbers.
     */
    public function update(ImpactNumberRequest $request)
    {
        $impactNumber = ImpactNumber::firstOrCreate([]);

        $impactNumber->update([
            'satisfied_clients' => $request->input('satisfied_clients'),
            'completed_projects' => $request->input('completed_projects'),
            'years_of_experience' => $request->input('years_of_experience'),
            'success_rate' => $request->input('success_rate'),
        ]);

        $url = route('admin.impact-numbers.edit');

        return update_response($url);
    }
}
