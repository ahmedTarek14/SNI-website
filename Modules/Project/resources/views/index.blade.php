@extends('layouts.master')
@push('css')
<style>
    .img-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        padding-top: 50px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.8);
        text-align: center;
    }

    .img-modal img {
        max-width: 90%;
        max-height: 90%;
    }
</style>
@endpush
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Projects
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Projects</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="col-md-6 col-sm-6 form-group">
                <label>Image</label>
                <input class="jfilestyle" type="file" name="image" required>
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Client</label>
                <input class="form-control" type="text" name="clint">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Date</label>
                <input class="form-control" type="date" name="date_at">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    <option value="">--select--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name ?? ('#' . $category->id) }}
                        </option>
                    @endforeach
                </select>
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Name ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="name_{{ $locale }}" required>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Description ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="description_{{ $locale }}" rows="3"></textarea>
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

    <div class="page-content">
        <div class="table-responsive-lg-lg">
            <table class="table table-bordered" id="datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $projects = $projects ?? \Modules\Project\Models\Project::with(['translations', 'category'])->get()->sortByDesc('id');
                    @endphp
                    @foreach ($projects as $index => $project)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ $project->image_path }}"
                                    style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                    onclick="openImage(this.src)">
                            </td>
                            
                            <td>{{ $project->translate('en')->name ?? '' }}</td>
                            <td>{{ $project->clint }}</td>
                            <td>{{ $project->date_at }}</td>
                            <td>
                                <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.projects.destroy', ['project' => $project->id]) }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div id="imgModal" class="img-modal" onclick="closeImage()">
        <img id="modalImg">
    </div>
@endsection
@push('js')
<script>
    function openImage(src) {
        document.getElementById("imgModal").style.display = "block";
        document.getElementById("modalImg").src = src;
    }

    function closeImage() {
        document.getElementById("imgModal").style.display = "none";
    }
</script>
@endpush