@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Challenges
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li><a href="{{ route('admin.challenges.index') }}">Challenges</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Project\Models\Challenge $challenge */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post"
            action="{{ route('admin.challenges.update', ['challenge' => $challenge->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="col-md-4 col-sm-6 form-group">
                <img src="{{ $challenge->image_path }}" style="width: 120px; height: 120px; object-fit: cover;">
                <label>Image</label>
                <input class="jfilestyle" type="file" name="image">
            </div>

            <div class="col-md-4 col-sm-6 form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="{{ $challenge->name }}">
            </div>

            <div class="col-md-4 col-sm-6 form-group">
                <label>Company</label>
                <input class="form-control" type="text" name="company" value="{{ $challenge->company }}">
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}"
                        value="{{ $challenge->translate($locale)->title ?? '' }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Result ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="result_{{ $locale }}"
                        value="{{ $challenge->translate($locale)->result ?? '' }}">
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Challenge ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="challenge_{{ $locale }}" rows="2">{{ $challenge->translate($locale)->challenge ?? '' }}</textarea>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Solution ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="solution_{{ $locale }}" rows="2">{{ $challenge->translate($locale)->solution ?? '' }}</textarea>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Description ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="description_{{ $locale }}" rows="3">{{ $challenge->translate($locale)->description ?? '' }}</textarea>
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

