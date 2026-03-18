@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Reviews
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Reviews</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.reviews.store') }}">
            @csrf

            <div class="col-md-4 col-sm-6 form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" required>
            </div>

            <div class="col-md-4 col-sm-6 form-group">
                <label>Rate (0–5)</label>
                <input class="form-control" type="number" name="rate" min="0" max="5" step="0.1" required>
            </div>

            <div class="col-md-12 col-sm-12 form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" rows="3" required></textarea>
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

    <div class="page-content">
        <div class="table-responsive-lg-lg">
            <table class="table table-bordered" id="datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Rate</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $reviews = $reviews ?? \Modules\Sni\Models\Review::orderByDesc('id')->get();
                    @endphp
                    @foreach ($reviews as $index => $review)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $review->name }}</td>
                            <td>{{ $review->rate }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($review->message, 120) }}</td>
                            <td>
                                <a href="{{ route('admin.reviews.edit', ['review' => $review->id]) }}"
                                    class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.reviews.destroy', ['review' => $review->id]) }}">
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

