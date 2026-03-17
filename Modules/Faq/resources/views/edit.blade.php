@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> FAQ
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li><a href="{{ route('admin.faqs.index') }}">FAQ</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Faq\Models\Faq $faq */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.faqs.update', ['faq' => $faq->id]) }}">
            @csrf
            @method('put')

            @foreach ($locales as $locale)
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Question ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="question_{{ $locale }}"
                        value="{{ $faq->translate($locale)->question ?? '' }}" required>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Answer ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="answer_{{ $locale }}" rows="3" required>{{ $faq->translate($locale)->answer ?? '' }}</textarea>
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

