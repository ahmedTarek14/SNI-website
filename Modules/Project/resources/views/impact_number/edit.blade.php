@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Impact Numbers
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Project\Models\ImpactNumber $impactNumber */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.impact-numbers.update') }}">
            @csrf
            @method('put')

            <div class="col-md-3 col-sm-6 form-group">
                <label>Satisfied Clients</label>
                <input class="form-control" type="number" name="satisfied_clients" min="0"
                    value="{{ $impactNumber->satisfied_clients }}">
            </div>

            <div class="col-md-3 col-sm-6 form-group">
                <label>Completed Projects</label>
                <input class="form-control" type="number" name="completed_projects" min="0"
                    value="{{ $impactNumber->completed_projects }}">
            </div>

            <div class="col-md-3 col-sm-6 form-group">
                <label>Years of Experience</label>
                <input class="form-control" type="number" name="years_of_experience" min="0"
                    value="{{ $impactNumber->years_of_experience }}">
            </div>

            <div class="col-md-3 col-sm-6 form-group">
                <label>Success Rate (%)</label>
                <input class="form-control" type="number" name="success_rate" min="0" max="100" step="0.01"
                    value="{{ $impactNumber->success_rate }}">
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

