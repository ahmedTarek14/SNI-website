@extends('layouts.master')
@section('content')
    @php
        /** @var \Modules\Service\Models\ServiceFeature $feature */
    @endphp

    <div class="page-head">
        <i class="fa fa-star"></i> Features
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>home</a></li>
            <li><a href="{{ route('admin.services.index') }}">Services</a></li>
            <li><a href="{{ route('admin.services.edit', ['service' => $service->id]) }}">{{ $service->translate('en')->title ?? 'Service' }}</a></li>
            <li><a href="{{ route('admin.service-features.index', ['service' => $service->id]) }}">Features</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    {{-- ── Service context header ──────────────────────────────────────── --}}
    <div class="page-content" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div style="display:flex;align-items:center;gap:12px;">
            <img src="{{ $service->image_path }}" alt="logo" style="height:48px;width:48px;object-fit:contain;border:1px solid #eee;border-radius:6px;padding:4px;">
            <div>
                <div style="font-size:12px;color:#999;text-transform:uppercase;letter-spacing:.5px;">Editing feature for</div>
                <h5 style="margin:0;">{{ $service->translate('en')->title ?? 'Service' }}</h5>
            </div>
        </div>
        <a href="{{ route('admin.service-features.index', ['service' => $service->id]) }}" class="custom-btn">
            <span><i class="fa fa-arrow-left"></i> Back to Features</span>
        </a>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post"
              action="{{ route('admin.service-features.update', ['feature' => $feature->id]) }}">
            @csrf
            @method('put')

            <div class="col-md-8 col-sm-8 form-group">
                <label>Icon Path</label>
                <div style="display:flex;align-items:center;gap:10px;">
                    <img id="edit-feature-icon-preview" src="{{ $feature->icon }}" alt=""
                        style="width:40px;height:40px;object-fit:contain;border:1px solid #eee;border-radius:4px;padding:2px;{{ $feature->icon ? '' : 'display:none;' }}"
                        onerror="this.style.display='none'">
                    <input class="form-control" type="text" name="icon" value="{{ $feature->icon }}"
                        placeholder="/assets/icons/security.png"
                        oninput="var p=document.getElementById('edit-feature-icon-preview'); if(this.value){p.src=this.value;p.style.display='inline-block';}else{p.style.display='none';}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4 form-group">
                <label>Sort Order</label>
                <input class="form-control" type="number" name="sort_order" value="{{ $feature->sort_order }}">
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}"
                        value="{{ $feature->translate($locale)->title ?? '' }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Description ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="description_{{ $locale }}" rows="2">{{ $feature->translate($locale)->description ?? '' }}</textarea>
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
