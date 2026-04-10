@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-users"></i> Team Members
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li><a href="{{ route('admin.team-members.index') }}">Team Members</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Sni\Models\TeamMember $teamMember */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post"
            action="{{ route('admin.team-members.update', ['teamMember' => $teamMember->id]) }}">
            @csrf
            @method('put')

            <div class="col-md-4 col-sm-6 form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="{{ $teamMember->name }}" required>
            </div>

            <div class="col-md-4 col-sm-6 form-group">
                <label>Role</label>
                <input class="form-control" type="text" name="role" value="{{ $teamMember->role }}" required>
            </div>

            <div class="col-md-4 col-sm-6 form-group">
                <label>Initial (max 5 chars)</label>
                <input class="form-control" type="text" name="initial" value="{{ $teamMember->initial }}"
                    maxlength="5" required>
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
@endsection
