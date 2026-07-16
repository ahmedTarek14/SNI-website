@extends('layouts.master')
@section('content')
    @php
        /** @var \Modules\Service\Models\ServiceProcess $process */
    @endphp

    <div class="page-head">
        <i class="fa fa-list-ol"></i> Process Steps
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>home</a></li>
            <li><a href="{{ route('admin.services.index') }}">Services</a></li>
            <li><a href="{{ route('admin.services.edit', ['service' => $service->id]) }}">{{ $service->translate('en')->title ?? 'Service' }}</a></li>
            <li><a href="{{ route('admin.service-processes.index', ['service' => $service->id]) }}">Process Steps</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    {{-- ── Service context header ──────────────────────────────────────── --}}
    <div class="page-content" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div style="display:flex;align-items:center;gap:12px;">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:50%;background:#eef3ff;color:#3b5bdb;font-weight:700;font-size:16px;">
                {{ $process->num }}
            </span>
            <div>
                <div style="font-size:12px;color:#999;text-transform:uppercase;letter-spacing:.5px;">Editing step for</div>
                <h5 style="margin:0;">{{ $service->translate('en')->title ?? 'Service' }}</h5>
            </div>
        </div>
        <a href="{{ route('admin.service-processes.index', ['service' => $service->id]) }}" class="custom-btn">
            <span><i class="fa fa-arrow-left"></i> Back to Process Steps</span>
        </a>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post"
              action="{{ route('admin.service-processes.update', ['process' => $process->id]) }}">
            @csrf
            @method('put')

            <div class="col-md-4 col-sm-4 form-group">
                <label>Step Number <small class="text-muted">(e.g. 01)</small></label>
                <input class="form-control" type="text" name="num" value="{{ $process->num }}" maxlength="4">
            </div>
            <div class="col-md-4 col-sm-4 form-group">
                <label>Sort Order</label>
                <input class="form-control" type="number" name="sort_order" value="{{ $process->sort_order }}">
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}"
                        value="{{ $process->translate($locale)->title ?? '' }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Description ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="description_{{ $locale }}" rows="2">{{ $process->translate($locale)->description ?? '' }}</textarea>
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
