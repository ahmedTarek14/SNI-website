@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Smart Features
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Smart Features</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.smart.features.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="col-md-12 col-sm-12 form-group">
                <label>Logo</label>
                <input class="jfilestyle" type="file" name="logo" required>
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Subtitle ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="subtitle_{{ $locale }}">
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
                        <th>Logo</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $features = $features ?? \Modules\Smart\Models\SmartFeature::with('translations')->get()->sortByDesc('id');
                    @endphp
                    @foreach ($features as $index => $feature)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src="{{ $feature->image_path }}" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"></td>
                            <td>{{ $feature->translate('en')->title ?? '' }}</td>
                            <td>{{ $feature->translate('en')->subtitle ?? '' }}</td>
                            <td>
                                <a href="{{ route('admin.smart.features.edit', ['smartFeature' => $feature->id]) }}"
                                    class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.smart.features.destroy', ['smartFeature' => $feature->id]) }}">
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

