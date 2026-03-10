@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Pages
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Pages</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <form class="row ajax-form" method="put" action="{{ route('admin.pages.update', ['page' => $page->slug]) }}">
            @csrf
            @method('put')

            <div class="col-md-12 col-sm-12 form-group">
                <label>Template </label>
                <input class="form-control" type="text" name="template" value="{{ $page->template }}" required>
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
