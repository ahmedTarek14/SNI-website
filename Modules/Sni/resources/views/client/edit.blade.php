@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Clients
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li><a href="{{ route('admin.clients.index') }}">Clients</a></li>
            <li class="active">Edit</li>
        </ul>
    </div>

    @php
        /** @var \Modules\Sni\Models\Client $client */
    @endphp

    <div class="page-content">
        <form class="row ajax-form" method="post"
            action="{{ route('admin.clients.update', ['client' => $client->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="col-md-6 col-sm-6 form-group">
                <img src="{{ $client->image_path }}" style="width: 120px; height: 120px; object-fit: cover;">
                <label>Logo</label>
                <input class="jfilestyle" type="file" name="logo">
            </div>

            <div class="col-md-6 col-sm-6 form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="{{ $client->name }}" required>
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

