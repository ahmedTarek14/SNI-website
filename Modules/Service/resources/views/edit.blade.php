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

    {{-- ── Features section ────────────────────────────────────────────── --}}
    <div class="page-content" style="margin-top:20px;">
        <h5 class="mb-3"><i class="fa fa-star"></i> What's Included (Features)</h5>

        {{-- Existing features --}}
        @if($features->count())
        <div class="table-responsive-lg mb-4">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Icon Path</th>
                        <th>Title (EN)</th>
                        <th>Title (AR)</th>
                        <th>Sort</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($features as $i => $feature)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><small>{{ $feature->icon }}</small></td>
                        <td>{{ $feature->translate('en')->title ?? '' }}</td>
                        <td>{{ $feature->translate('ar')->title ?? '' }}</td>
                        <td>{{ $feature->sort_order }}</td>
                        <td>
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

        {{-- Add new feature --}}
        <form class="row ajax-form" method="post"
              action="{{ route('admin.service-features.store', ['service' => $service->id]) }}">
            @csrf
            <div class="col-md-12"><h6>Add Feature</h6></div>

            <div class="col-md-8 col-sm-8 form-group">
                <label>Icon Path</label>
                <input class="form-control" type="text" name="icon" placeholder="/assets/icons/security.png">
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

            <div class="col-md-12 form-group">
                <button class="custom-btn"><span><i class="fa fa-plus"></i> Add Feature</span></button>
            </div>
        </form>
    </div>

    {{-- ── Process steps section ───────────────────────────────────────── --}}
    <div class="page-content" style="margin-top:20px;">
        <h5 class="mb-3"><i class="fa fa-list-ol"></i> How We Work (Process Steps)</h5>

        {{-- Existing processes --}}
        @if($processes->count())
        <div class="table-responsive-lg mb-4">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Num</th>
                        <th>Title (EN)</th>
                        <th>Title (AR)</th>
                        <th>Sort</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($processes as $i => $process)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $process->num }}</td>
                        <td>{{ $process->translate('en')->title ?? '' }}</td>
                        <td>{{ $process->translate('ar')->title ?? '' }}</td>
                        <td>{{ $process->sort_order }}</td>
                        <td>
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

        {{-- Add new process step --}}
        <form class="row ajax-form" method="post"
              action="{{ route('admin.service-processes.store', ['service' => $service->id]) }}">
            @csrf
            <div class="col-md-12"><h6>Add Process Step</h6></div>

            <div class="col-md-4 col-sm-4 form-group">
                <label>Step Number <small class="text-muted">(e.g. 01)</small></label>
                <input class="form-control" type="text" name="num" value="{{ str_pad($processes->count() + 1, 2, '0', STR_PAD_LEFT) }}" maxlength="4">
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

            <div class="col-md-12 form-group">
                <button class="custom-btn"><span><i class="fa fa-plus"></i> Add Step</span></button>
            </div>
        </form>
    </div>
@endsection
