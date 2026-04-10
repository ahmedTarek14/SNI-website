@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Core Values
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Core Values</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.core-values.store') }}">
            @csrf

            <div class="col-md-6 col-sm-6 form-group">
                <label>Icon (CSS class or emoji)</label>
                <input class="form-control" type="text" name="icon" placeholder="e.g. fa fa-star or 🌟">
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}" required>
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
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $coreValues = $coreValues ?? \Modules\Sni\Models\CoreValue::with('translations')->get()->sortByDesc('id');
                    @endphp
                    @foreach ($coreValues as $index => $coreValue)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $coreValue->icon }}</td>
                            <td>{{ $coreValue->translate('en')->title ?? '' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($coreValue->translate('en')->description ?? '', 100) }}</td>
                            <td>
                                <a href="{{ route('admin.core-values.edit', ['coreValue' => $coreValue->id]) }}"
                                    class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.core-values.destroy', ['coreValue' => $coreValue->id]) }}">
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
