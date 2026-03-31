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
        <i class="fa fa-list"></i> Services
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Services</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="col-md-12 col-sm-12 form-group">
                <label>Logo</label>
                <input class="jfilestyle" type="file" name="logo" required>
            </div>

            <div class="col-md-12 col-sm-12 form-group">
                <label>Slug <small class="text-muted">(URL identifier, e.g. it-consulting)</small></label>
                <input class="form-control" type="text" name="slug" placeholder="e.g. it-consulting" required>
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Subtitle ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="subtitle_{{ $locale }}">
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
                        <th>Logo</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $services = $services ?? \Modules\Service\Models\Service::with('translations')->get()->sortByDesc('id');
                    @endphp
                    @foreach ($services as $index => $service)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ $service->image_path }}"
                                    style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                    onclick="openImage(this.src)">
                            </td>
                            <td>{{ $service->translate('en')->title ?? '' }}</td>
                            <td>{{ $service->translate('en')->subtitle ?? '' }}</td>
                            <td>
                                <a href="{{ route('admin.services.edit', ['service' => $service->id]) }}" class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.services.destroy', ['service' => $service->id]) }}">
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