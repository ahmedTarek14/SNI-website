@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Locations
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Settings\Models\Location $location */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.locations.update', ['location' => $location->id]) }}">
            @csrf
            @method('put')

            <div class="col-md-6 col-sm-6 form-group">
                <label>Lat</label>
                <input class="form-control" type="text" name="lat" value="{{ $location->lat }}">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Lng</label>
                <input class="form-control" type="text" name="lng" value="{{ $location->lng }}">
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Address ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="address_{{ $locale }}"
                        value="{{ $location->translate($locale)->address ?? '' }}" required>
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

