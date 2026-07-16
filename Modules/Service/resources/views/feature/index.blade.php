@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-star"></i> Features
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>home</a></li>
            <li><a href="{{ route('admin.services.index') }}">Services</a></li>
            <li><a href="{{ route('admin.services.edit', ['service' => $service->id]) }}">{{ $service->translate('en')->title ?? 'Service' }}</a></li>
            <li class="active">Features</li>
        </ul>
    </div>

    {{-- ── Service context header ──────────────────────────────────────── --}}
    <div class="page-content" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div style="display:flex;align-items:center;gap:12px;">
            <img src="{{ $service->image_path }}" alt="logo" style="height:48px;width:48px;object-fit:contain;border:1px solid #eee;border-radius:6px;padding:4px;">
            <div>
                <div style="font-size:12px;color:#999;text-transform:uppercase;letter-spacing:.5px;">Managing features for</div>
                <h5 style="margin:0;">{{ $service->translate('en')->title ?? 'Service' }}</h5>
            </div>
        </div>
        <a href="{{ route('admin.services.edit', ['service' => $service->id]) }}" class="custom-btn">
            <span><i class="fa fa-arrow-left"></i> Back to Service</span>
        </a>
    </div>

    <div class="page-content" id="add-feature-form">
        <h5 class="mb-3"><i class="fa fa-plus"></i> Add Feature</h5>
        <form class="row ajax-form" method="post"
              action="{{ route('admin.service-features.store', ['service' => $service->id]) }}">
            @csrf

            <div class="col-md-8 col-sm-8 form-group">
                <label>Icon Path</label>
                <div style="display:flex;align-items:center;gap:10px;">
                    <img id="new-feature-icon-preview" src="" alt="" style="display:none;width:40px;height:40px;object-fit:contain;border:1px solid #eee;border-radius:4px;padding:2px;"
                        onerror="this.style.display='none'">
                    <input class="form-control" type="text" name="icon" placeholder="/assets/icons/security.png"
                        oninput="var p=document.getElementById('new-feature-icon-preview'); if(this.value){p.src=this.value;p.style.display='inline-block';}else{p.style.display='none';}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4 form-group">
                <label>Sort Order</label>
                <input class="form-control" type="number" name="sort_order" value="{{ $features->count() }}">
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Description ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="description_{{ $locale }}" rows="2"></textarea>
                </div>
            @endforeach

            <div class="col-md-12 col-sm-12 form-group">
                <button class="custom-btn"><span><i class="fa fa-plus"></i> Add Feature</span></button>
            </div>
        </form>
    </div>

    <div class="page-content">
        @if ($features->isEmpty())
            <div class="text-center" style="padding:60px 20px;">
                <i class="fa fa-star" style="font-size:48px;color:#ddd;display:block;margin-bottom:15px;"></i>
                <h5>No features yet</h5>
                <p class="text-muted">This service doesn't have any features added.</p>
                <a href="#add-feature-form" class="custom-btn"><span><i class="fa fa-plus"></i> Add first feature</span></a>
            </div>
        @else
            <div class="table-responsive-lg-lg">
                <table class="table table-bordered" id="datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Icon</th>
                            <th>Title (EN)</th>
                            <th>Title (AR)</th>
                            <th>Sort</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($features as $index => $feature)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <img src="{{ $feature->icon }}" alt="" style="width:36px;height:36px;object-fit:contain;border:1px solid #eee;border-radius:4px;padding:2px;"
                                            onerror="this.style.visibility='hidden'">
                                        <small class="text-muted">{{ $feature->icon }}</small>
                                    </div>
                                </td>
                                <td>{{ $feature->translate('en')->title ?? '' }}</td>
                                <td>{{ $feature->translate('ar')->title ?? '' }}</td>
                                <td>{{ $feature->sort_order }}</td>
                                <td>
                                    <a href="{{ route('admin.service-features.edit', ['feature' => $feature->id]) }}"
                                        class="icon-btn green-bc">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                        data-url="{{ route('admin.service-features.destroy', ['feature' => $feature->id]) }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
