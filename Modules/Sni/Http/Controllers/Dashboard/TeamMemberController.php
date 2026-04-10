<?php

namespace Modules\Sni\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Sni\Http\Requests\TeamMemberRequest;
use Modules\Sni\Models\TeamMember;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderByDesc('id')->get();

        return view('sni::team_member.index', compact('teamMembers'));
    }

    public function store(TeamMemberRequest $request)
    {
        try {
            TeamMember::create($request->validated());

            $url = route('admin.team-members.index');

            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function edit(TeamMember $teamMember)
    {
        return view('sni::team_member.edit', compact('teamMember'));
    }

    public function update(TeamMemberRequest $request, TeamMember $teamMember)
    {
        try {
            $teamMember->update($request->validated());

            $url = route('admin.team-members.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->back();
    }
}
