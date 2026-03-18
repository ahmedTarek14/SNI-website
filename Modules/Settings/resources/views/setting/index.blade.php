@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Settings
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Settings</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="col-md-12 col-sm-12 form-group">
                <label>Logo</label>
                <input class="jfilestyle" type="file" name="logo">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Phone</label>
                <input class="form-control" type="text" name="phone">
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

    <div class="page-content">
        <div class="table-responsive-lg-lg">
            <table class="table table-bordered" id="datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $settings = $settings ?? \Modules\Settings\Models\Setting::query()->get()->sortByDesc('id');
                    @endphp
                    @foreach ($settings as $index => $setting)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src="{{ $setting->image_path }}"></td>
                            <td>{{ $setting->email }}</td>
                            <td>{{ $setting->phone }}</td>
                            <td>
                                <a href="{{ route('admin.settings.edit', ['setting' => $setting->id]) }}"
                                    class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.settings.destroy', ['setting' => $setting->id]) }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

