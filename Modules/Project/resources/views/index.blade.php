@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Projects
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Projects</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="col-md-6 col-sm-6 form-group">
                <label>Image</label>
                <input class="jfilestyle" type="file" name="image" required>
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Client</label>
                <input class="form-control" type="text" name="clint">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Date</label>
                <input class="form-control" type="date" name="date_at">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Development</label>
                <select class="form-control" name="development_id">
                    <option value="">--select--</option>
                    @php
                        $developments = $developments ?? \Modules\Development\Models\Development::with('translations')->get();
                    @endphp
                    @foreach ($developments as $development)
                        <option value="{{ $development->id }}">{{ $development->translate('en')->title ?? ('#' . $development->id) }}
                        </option>
                    @endforeach
                </select>
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Name ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="name_{{ $locale }}" required>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Description ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="description_{{ $locale }}" rows="3"></textarea>
                </div>
            @endforeach

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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $projects = $projects ?? \Modules\Project\Models\Project::with(['translations', 'development'])->get()->sortByDesc('id');
                    @endphp
                    @foreach ($projects as $index => $project)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src="{{ $project->image_path }}"></td>
                            <td>{{ $project->translate('en')->name ?? '' }}</td>
                            <td>{{ $project->clint }}</td>
                            <td>{{ $project->date_at }}</td>
                            <td>
                                <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.projects.destroy', ['project' => $project->id]) }}">
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
