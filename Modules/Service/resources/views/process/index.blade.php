@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list-ol"></i> Process Steps
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>home</a></li>
            <li><a href="{{ route('admin.services.index') }}">Services</a></li>
            <li><a href="{{ route('admin.services.edit', ['service' => $service->id]) }}">{{ $service->translate('en')->title ?? 'Service' }}</a></li>
            <li class="active">Process Steps</li>
        </ul>
    </div>

    {{-- ── Service context header ──────────────────────────────────────── --}}
    <div class="page-content" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div style="display:flex;align-items:center;gap:12px;">
            <img src="{{ $service->image_path }}" alt="logo" style="height:48px;width:48px;object-fit:contain;border:1px solid #eee;border-radius:6px;padding:4px;">
            <div>
                <div style="font-size:12px;color:#999;text-transform:uppercase;letter-spacing:.5px;">Managing process steps for</div>
                <h5 style="margin:0;">{{ $service->translate('en')->title ?? 'Service' }}</h5>
            </div>
        </div>
        <a href="{{ route('admin.services.edit', ['service' => $service->id]) }}" class="custom-btn">
            <span><i class="fa fa-arrow-left"></i> Back to Service</span>
        </a>
    </div>

    <div class="page-content" id="add-step-form">
        <h5 class="mb-3"><i class="fa fa-plus"></i> Add Process Step</h5>
        <form class="row ajax-form" method="post"
              action="{{ route('admin.service-processes.store', ['service' => $service->id]) }}">
            @csrf

            <div class="col-md-4 col-sm-4 form-group">
                <label>Step Number <small class="text-muted">(e.g. 01)</small></label>
                <input class="form-control" type="text" name="num"
                    value="{{ str_pad($processes->count() + 1, 2, '0', STR_PAD_LEFT) }}" maxlength="4">
            </div>
            <div class="col-md-4 col-sm-4 form-group">
                <label>Sort Order</label>
                <input class="form-control" type="number" name="sort_order" value="{{ $processes->count() }}">
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
                <button class="custom-btn"><span><i class="fa fa-plus"></i> Add Step</span></button>
            </div>
        </form>
    </div>

    <div class="page-content">
        @if ($processes->isEmpty())
            <div class="text-center" style="padding:60px 20px;">
                <i class="fa fa-list-ol" style="font-size:48px;color:#ddd;display:block;margin-bottom:15px;"></i>
                <h5>No process steps yet</h5>
                <p class="text-muted">This service doesn't have a "How We Work" flow defined.</p>
                <a href="#add-step-form" class="custom-btn"><span><i class="fa fa-plus"></i> Add first step</span></a>
            </div>
        @else
            <div class="table-responsive-lg-lg">
                <table class="table table-bordered" id="datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Step</th>
                            <th>Title (EN)</th>
                            <th>Title (AR)</th>
                            <th>Sort</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($processes as $index => $process)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background:#eef3ff;color:#3b5bdb;font-weight:700;">
                                        {{ $process->num }}
                                    </span>
                                </td>
                                <td>{{ $process->translate('en')->title ?? '' }}</td>
                                <td>{{ $process->translate('ar')->title ?? '' }}</td>
                                <td>{{ $process->sort_order }}</td>
                                <td>
                                    <a href="{{ route('admin.service-processes.edit', ['process' => $process->id]) }}"
                                        class="icon-btn green-bc">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                        data-url="{{ route('admin.service-processes.destroy', ['process' => $process->id]) }}">
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
