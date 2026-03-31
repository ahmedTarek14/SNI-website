@extends('layouts.master')
@section('content')
    @php
        /** @var \Modules\Project\Models\Project $project */
        $galleryImages = $project->images()->orderBy('sort_order')->get();
    @endphp

    <div class="page-head">
        <i class="fa fa-list"></i> Projects
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>home</a></li>
            <li><a href="{{ route('admin.projects.index') }}">Projects</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    {{-- ── Main project form ──────────────────────────────────────────────── --}}
    <div class="page-content">
        <h5 class="mb-3"><i class="fa fa-cog"></i> Project Details</h5>
        <form class="row ajax-form" method="post"
              action="{{ route('admin.projects.update', ['project' => $project->id]) }}"
              enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="col-md-6 col-sm-6 form-group">
                <img src="{{ $project->image_path }}" alt="cover" style="height:70px;object-fit:cover;border-radius:6px;margin-bottom:6px;display:block;">
                <label>Cover Image</label>
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
                    <option value="">-- select --</option>
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
                    <textarea class="form-control" name="description_{{ $locale }}" rows="4">{{ $project->translate($locale)->description ?? '' }}</textarea>
                </div>
            @endforeach

            <div class="col-md-12"><hr>
                <button class="custom-btn"><span><i class="fa fa-save"></i> Save Project</span></button>
            </div>
        </form>
    </div>

    {{-- ── Gallery images section ─────────────────────────────────────────── --}}
    <div class="page-content" style="margin-top:20px;">
        <h5 class="mb-3"><i class="fa fa-images"></i> Gallery Images
            <small class="text-muted" style="font-size:13px;font-weight:400;"> — shown in the project detail slider</small>
        </h5>

        @if($galleryImages->count())
        <div style="display:flex;flex-wrap:wrap;gap:14px;margin-bottom:24px;">
            @foreach($galleryImages as $img)
            <div style="position:relative;width:140px;">
                <img src="{{ $img->image_path }}" alt="gallery"
                     style="width:140px;height:100px;object-fit:cover;border-radius:8px;border:1px solid #eee;">
                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                   data-url="{{ route('admin.project-images.destroy', ['projectImage' => $img->id]) }}"
                   style="position:absolute;top:4px;right:4px;width:26px;height:26px;font-size:11px;">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            @endforeach
        </div>
        @else
            <p class="text-muted mb-4" style="font-size:13px;">No gallery images yet.</p>
        @endif

        <form class="row ajax-form" method="post"
              action="{{ route('admin.project-images.store', ['project' => $project->id]) }}"
              enctype="multipart/form-data">
            @csrf
            <div class="col-md-12 form-group">
                <label>Upload Images <small class="text-muted">(select multiple)</small></label>
                <input class="jfilestyle" type="file" name="images[]" multiple>
            </div>
            <div class="col-md-12 form-group">
                <button class="custom-btn"><span><i class="fa fa-upload"></i> Upload Images</span></button>
            </div>
        </form>
    </div>
@endsection
