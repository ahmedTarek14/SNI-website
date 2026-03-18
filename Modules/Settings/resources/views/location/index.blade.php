@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Locations
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Locations</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.locations.store') }}">
            @csrf

            <div class="col-md-6 col-sm-6 form-group">
                <label>Lat</label>
                <input class="form-control" type="text" name="lat">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Lng</label>
                <input class="form-control" type="text" name="lng">
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Address ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="address_{{ $locale }}" required>
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
                        <th>Address</th>
                        <th>Lat</th>
                        <th>Lng</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $locations = $locations ?? \Modules\Settings\Models\Location::with('translations')->get()->sortByDesc('id');
                    @endphp
                    @foreach ($locations as $index => $location)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $location->translate('en')->address ?? '' }}</td>
                            <td>{{ $location->lat }}</td>
                            <td>{{ $location->lng }}</td>
                            <td>
                                <a href="{{ route('admin.locations.edit', ['location' => $location->id]) }}"
                                    class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.locations.destroy', ['location' => $location->id]) }}">
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

