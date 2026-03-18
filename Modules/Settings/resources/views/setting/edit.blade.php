@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Settings
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Settings\Models\Setting $setting */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.settings.update', ['setting' => $setting->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="col-md-12 col-sm-12 form-group">
                <img src="{{ $setting->image_path }}" alt="logo">
                <label>Logo</label>
                <input class="jfilestyle" type="file" name="logo">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" value="{{ $setting->email }}">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Phone</label>
                <input class="form-control" type="text" name="phone" value="{{ $setting->phone }}">
            </div>

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

