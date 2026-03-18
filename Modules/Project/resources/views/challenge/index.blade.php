@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Challenges
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Challenges</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.challenges.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="col-md-4 col-sm-6 form-group">
                <label>Image</label>
                <input class="jfilestyle" type="file" name="image" required>
            </div>

            <div class="col-md-4 col-sm-6 form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name">
            </div>

            <div class="col-md-4 col-sm-6 form-group">
                <label>Company</label>
                <input class="form-control" type="text" name="company">
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Result ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="result_{{ $locale }}">
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Challenge ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="challenge_{{ $locale }}" rows="2"></textarea>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Solution ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="solution_{{ $locale }}" rows="2"></textarea>
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
                        <th>Title</th>
                        <th>Company</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $challenges = $challenges ?? \Modules\Project\Models\Challenge::with('translations')->get()->sortByDesc('id');
                    @endphp
                    @foreach ($challenges as $index => $challenge)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ $challenge->image_path }}"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                            </td>
                            <td>{{ $challenge->translate('en')->title ?? '' }}</td>
                            <td>{{ $challenge->company }}</td>
                            <td>
                                <a href="{{ route('admin.challenges.edit', ['challenge' => $challenge->id]) }}"
                                    class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.challenges.destroy', ['challenge' => $challenge->id]) }}">
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

