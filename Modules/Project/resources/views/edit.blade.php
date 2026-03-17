@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Projects
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li><a href="{{ route('admin.projects.index') }}">Projects</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>
    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.projects.update', ['project' => $project->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="col-md-6 col-sm-6 form-group">
                <img src="{{ $project->image_path }}" alt="image">
                <label>Image</label>
                <input class="jfilestyle" type="file" name="image">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Client</label>
                <input class="form-control" type="text" name="clint" value="{{ $project->clint }}">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Date</label>
                <input class="form-control" type="date" name="date_at" value="{{ $project->date_at }}">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    <option value="">--select--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ (int) $project->category_id === (int) $category->id ? 'selected' : '' }}>
                            {{ $category->name ?? ('#' . $category->id) }}
                        </option>
                    @endforeach
                </select>
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Name ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="name_{{ $locale }}"
                        value="{{ $project->translate($locale)->name ?? '' }}" required>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Description ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="description_{{ $locale }}" rows="3">{{ $project->translate($locale)->description ?? '' }}</textarea>
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

