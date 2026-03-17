@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> FAQ
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">FAQ</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.faqs.store') }}">
            @csrf

            @foreach ($locales as $locale)
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Question ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="question_{{ $locale }}" required>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Answer ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="answer_{{ $locale }}" rows="3" required></textarea>
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
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $faqs = $faqs ?? \Modules\Faq\Models\Faq::with('translations')->get()->sortByDesc('id');
                    @endphp
                    @foreach ($faqs as $index => $faq)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $faq->translate('en')->question ?? '' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($faq->translate('en')->answer ?? '', 120) }}</td>
                            <td>
                                <a href="{{ route('faq.edit', ['faq' => $faq->id]) }}" class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('faq.destroy', ['faq' => $faq->id]) }}">
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
