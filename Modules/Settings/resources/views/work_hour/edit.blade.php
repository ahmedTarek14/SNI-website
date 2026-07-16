@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Work Hours
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Settings\Models\WorkHour $workHour */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post"
            action="{{ route('admin.work-hours.update', ['workHour' => $workHour->id]) }}">
            @csrf
            @method('put')

            <div class="col-md-4 col-sm-4 form-group">
                <label>Open Time</label>
                <input class="form-control" type="time" name="open_time" value="{{ $workHour->open_time }}">
            </div>
            <div class="col-md-4 col-sm-4 form-group">
                <label>Close Time</label>
                <input class="form-control" type="time" name="close_time" value="{{ $workHour->close_time }}">
            </div>
            <div class="col-md-4 col-sm-4 form-group">
                <label>Day</label>
                <select class="form-control" name="day_key" required>
                    @foreach (\Modules\Settings\Models\WorkHour::DAYS as $key => $label)
                        <option value="{{ $key }}" {{ $workHour->day_key === $key ? 'selected' : '' }}>{{ $label['en'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 col-sm-12 form-group">
                <label class="d-block">Off</label>
                <input type="hidden" name="is_off" value="0">
                <input type="checkbox" name="is_off" value="1" {{ $workHour->is_off ? 'checked' : '' }}> Closed all day
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

