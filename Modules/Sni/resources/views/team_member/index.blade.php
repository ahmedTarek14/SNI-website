@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-users"></i> Team Members
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Team Members</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.team-members.store') }}">
            @csrf

            <div class="col-md-4 col-sm-6 form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" required>
            </div>

            <div class="col-md-4 col-sm-6 form-group">
                <label>Role</label>
                <input class="form-control" type="text" name="role" required>
            </div>

            <div class="col-md-4 col-sm-6 form-group">
                <label>Initial (max 5 chars)</label>
                <input class="form-control" type="text" name="initial" maxlength="5" required>
            </div>

            <div class="col-md-12 col-sm-12">
                <hr>
            </div>

            <div class="col-md-12 col-sm-12 form-group">
                <button class="custom-btn">
                    <span><i class="fa fa-save"></i> save</span>
                </button>
            </div>
        </form>
    </div>

    <div class="page-content">
        <div class="table-responsive-lg-lg">
            <table class="table table-bordered" id="datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Initial</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $teamMembers = $teamMembers ?? \Modules\Sni\Models\TeamMember::orderByDesc('id')->get();
                    @endphp
                    @foreach ($teamMembers as $index => $member)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->role }}</td>
                            <td>{{ $member->initial }}</td>
                            <td>
                                <a href="{{ route('admin.team-members.edit', ['teamMember' => $member->id]) }}"
                                    class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.team-members.destroy', ['teamMember' => $member->id]) }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
