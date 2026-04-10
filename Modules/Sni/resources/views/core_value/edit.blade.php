@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Core Values
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li><a href="{{ route('admin.core-values.index') }}">Core Values</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Sni\Models\CoreValue $coreValue */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post"
            action="{{ route('admin.core-values.update', ['coreValue' => $coreValue->id]) }}">
            @csrf
            @method('put')

            <div class="col-md-6 col-sm-6 form-group">
                <label>Icon (CSS class or emoji)</label>
                <input class="form-control" type="text" name="icon" value="{{ $coreValue->icon }}"
                    placeholder="e.g. fa fa-star or 🌟">
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}"
                        value="{{ $coreValue->translate($locale)->title ?? '' }}" required>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Description ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="description_{{ $locale }}"
                        rows="3">{{ $coreValue->translate($locale)->description ?? '' }}</textarea>
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
