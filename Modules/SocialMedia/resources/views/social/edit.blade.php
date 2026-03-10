@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Social Media
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Social Media</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <form class="row ajax-form" method="put" action="{{ route('admin.links.update', ['socialMedia' => $socialMedia->id]) }}">
            @csrf
            @method('put')

            <div class="col-md-6 col-sm-6 form-group">
                <label>Platform</label>
                <input class="form-control" type="text" name="platform" value="{{ $socialMedia->platform }}">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Link</label>
                <input class="form-control" type="text" name="link" value="{{ $socialMedia->link }}">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <img src="{{ $link->image_path }}" alt="logo">
                <label>Logo</label>
                <input class="jfilestyle" type="file" name="logo">
            </div>

            <div class="col-md-12 col-sm-12">
                <hr>
            </div>
            <div class="col-md-12 col-sm-12 form-group">
                <button class="custom-btn">
                    <span> <i class="fa fa-save"></i> save</span>
                </button>

            </div>

        </form>
    </div><!--End Page content-->
@endsection
