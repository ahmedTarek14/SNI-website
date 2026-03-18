@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Smart Benefits
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Smart\Models\SmartBenefit $smartBenefit */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post"
            action="{{ route('admin.smart.benefits.update', ['smartBenefit' => $smartBenefit->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="col-md-12 col-sm-12 form-group">
                <img src="{{ $smartBenefit->image_path }}" alt="logo">
                <label>Logo</label>
                <input class="jfilestyle" type="file" name="logo">
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}"
                        value="{{ $smartBenefit->translate($locale)->title ?? '' }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Subtitle ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="subtitle_{{ $locale }}"
                        value="{{ $smartBenefit->translate($locale)->subtitle ?? '' }}">
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
@endsection

