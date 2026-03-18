@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Work Hours
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Work Hours</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.work-hours.store') }}">
            @csrf

            <div class="col-md-4 col-sm-4 form-group">
                <label>Open Time</label>
                <input class="form-control" type="time" name="open_time">
            </div>
            <div class="col-md-4 col-sm-4 form-group">
                <label>Close Time</label>
                <input class="form-control" type="time" name="close_time">
            </div>
            <div class="col-md-4 col-sm-4 form-group">
                <label>Off</label>
                <select class="form-control" name="is_off">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            @foreach ($locales as $locale)
                <div class="col-md-6 col-sm-6 form-group">
                    <label>Day ({{ strtoupper($locale) }})</label>
                    <input class="form-control" type="text" name="day_{{ $locale }}" required>
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
                        <th>Day</th>
                        <th>Open</th>
                        <th>Close</th>
                        <th>Off</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $workHours = $workHours ?? \Modules\Settings\Models\WorkHour::with('translations')->get()->sortByDesc('id');
                    @endphp
                    @foreach ($workHours as $index => $workHour)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $workHour->translate('en')->day ?? '' }}</td>
                            <td>{{ $workHour->open_time }}</td>
                            <td>{{ $workHour->close_time }}</td>
                            <td>{{ $workHour->is_off ? 'Yes' : 'No' }}</td>
                            <td>
                                <a href="{{ route('admin.work-hours.edit', ['workHour' => $workHour->id]) }}"
                                    class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {{-- <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.work-hours.destroy', ['workHour' => $workHour->id]) }}">
                                    <i class="fas fa-trash"></i>
                                </a> --}}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

