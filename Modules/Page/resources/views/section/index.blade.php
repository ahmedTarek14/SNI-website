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
    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.sections.store') }}">
            @csrf

            <div class="col-md-12 col-sm-12 form-group">
                <label>Page</label>
                <select class="form-control" name="page_id" required>
                    <option value="">--select--</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}">{{ $page->template }}</option>
                    @endforeach
                </select>
            </div>

            @foreach($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Title ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="title_{{ $locale }}" required>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Subtitle ({{ strtoupper($locale) }})</label>
                    <input class="form-control" name="subtitle_{{ $locale }}">
                </div>
            @endforeach
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
                        <th>Page</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $index => $section)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $section->page?->template }}</td>
                            <td>{{ $section->translate('en')->title ?? '' }}</td>
                            <td>{{ $section->translate('en')->subtitle ?? '' }}</td>
                            <td>
                                <a href="{{ route('admin.sections.edit', ['section' => $section->id]) }}" class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.sections.destroy', ['section' => $section->id]) }}">
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