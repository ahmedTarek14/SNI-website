@extends('layouts.master')
@section('content')
    @php
        /** @var \Modules\Service\Models\Service $service */
        $features  = $service->features()->with('translations')->orderBy('sort_order')->get();
        $processes = $service->processes()->with('translations')->orderBy('sort_order')->get();
    @endphp

    <div class="page-head">
        <i class="fa fa-list"></i> Services
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>home</a></li>
            <li><a href="{{ route('admin.services.index') }}">Services</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    {{-- ── Main service form ───────────────────────────────────────────── --}}
    <div class="page-content">
        <h5 class="mb-3"><i class="fa fa-cog"></i> Service Details</h5>
        <form class="row ajax-form" method="post"
              action="{{ route('admin.services.update', ['service' => $service->id]) }}"
              enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="col-md-6 col-sm-6 form-group">
                <img src="{{ $service->image_path }}" alt="logo" style="height:60px;object-fit:contain;margin-bottom:6px;display:block;">
                <label>Logo</label>
                <input class="jfilestyle" type="file" name="logo">
            </div>

            <div class="col-md-6 col-sm-6 form-group">
                <label>Slug <small class="text-muted">(URL identifier, e.g. it-consulting)</small></label>
                <input class="form-control" type="text" name="slug" value="{{ $service->slug }}" required>
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}"
                           value="{{ $service->translate($locale)->title ?? '' }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Subtitle ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="subtitle_{{ $locale }}"
                           value="{{ $service->translate($locale)->subtitle ?? '' }}">
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Description ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="description_{{ $locale }}" rows="3">{{ $service->translate($locale)->description ?? '' }}</textarea>
                </div>
            @endforeach

            <div class="col-md-12 col-sm-12">
                <hr>
                <button class="custom-btn"><span><i class="fa fa-save"></i> Save Service</span></button>
            </div>
        </form>
    </div>

    {{-- ── Features & process steps management ────────────────────────── --}}
    <div class="page-content" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h5 class="mb-3"><i class="fa fa-star"></i> What's Included (Features)</h5>
                <p>{{ $features->count() }} feature(s) added.</p>
                <a href="{{ route('admin.service-features.index', ['service' => $service->id]) }}" class="custom-btn">
                    <span><i class="fa fa-list"></i> Manage Features</span>
                </a>
            </div>
            <div class="col-md-6 col-sm-6">
                <h5 class="mb-3"><i class="fa fa-list-ol"></i> How We Work (Process Steps)</h5>
                <p>{{ $processes->count() }} step(s) added.</p>
                <a href="{{ route('admin.service-processes.index', ['service' => $service->id]) }}" class="custom-btn">
                    <span><i class="fa fa-list"></i> Manage Process Steps</span>
                </a>
            </div>
        </div>
    </div>
@endsection
