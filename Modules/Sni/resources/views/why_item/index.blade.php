@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Why SNI Items
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Why SNI Items</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.why-items.store') }}">
            @csrf

            @foreach ($locales as $locale)
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Text ({{ strtoupper($locale) }})</label>
                    <textarea class="form-control" name="text_{{ $locale }}" rows="3" required></textarea>
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
                        <th>Text</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $whyItems = $whyItems ?? \Modules\Sni\Models\WhyItem::with('translations')->get()->sortByDesc('id');
                    @endphp
                    @foreach ($whyItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->translate('en')->text ?? '', 120) }}</td>
                            <td>
                                <a href="{{ route('admin.why-items.edit', ['whyItem' => $item->id]) }}"
                                    class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.why-items.destroy', ['whyItem' => $item->id]) }}">
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
