@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Sections
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Sections</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <form class="row ajax-form" method="put" action="{{ route('admin.sections.update', ['section' => $section->id]) }}">
            @csrf
            @method('put')

            <div class="col-md-12 col-sm-12 form-group">
                <label>Page</label>
                <select class="form-control" name="page_id" required>
                    <option value="">--select--</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}" {{ $section->page_id == $page->id ? 'selected' : '' }}>{{ $page->template }}</option>
                    @endforeach
                </select>
            </div>

            @foreach($locales as $locale)
                <div class="col-md-6 col-sm-12 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}"
                        value="{{ $section->translate($locale)->title }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Subtitle ({{ strtoupper($locale) }})</label>
                    <input class="form-control" name="subtitle_{{ $locale }}" value="{{ $section->translate($locale)->subtitle }}">
                </div>
            @endforeach

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