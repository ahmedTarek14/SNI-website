@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Why SNI Items
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li><a href="{{ route('admin.why-items.index') }}">Why SNI Items</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Sni\Models\WhyItem $whyItem */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post"
            action="{{ route('admin.why-items.update', ['whyItem' => $whyItem->id]) }}">
            @csrf
            @method('put')

            @foreach ($locales as $locale)
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Text ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="text_{{ $locale }}" rows="3"
                        required>{{ $whyItem->translate($locale)->text ?? '' }}</textarea>
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
