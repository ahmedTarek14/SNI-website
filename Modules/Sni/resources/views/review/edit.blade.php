@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Reviews
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li><a href="{{ route('admin.reviews.index') }}">Reviews</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Sni\Models\Review $review */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post"
            action="{{ route('admin.reviews.update', ['review' => $review->id]) }}">
            @csrf
            @method('put')

            <div class="col-md-4 col-sm-6 form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="{{ $review->name }}" required>
            </div>

            <div class="col-md-4 col-sm-6 form-group">
                <label>Rate (0–5)</label>
                <input class="form-control" type="number" name="rate" min="0" max="5" step="0.1"
                    value="{{ $review->rate }}" required>
            </div>

            <div class="col-md-12 col-sm-12 form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" rows="3" required>{{ $review->message }}</textarea>
            </div>

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

