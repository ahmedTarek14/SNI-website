@extends('layouts.master')

@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Clients
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Clients</li>
        </ul>
    </div>

    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.clients.store') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="col-md-6 col-sm-6 form-group">
                <label>Logo</label>
                <input class="jfilestyle" type="file" name="logo" required>
            </div>

            <div class="col-md-6 col-sm-6 form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" required>
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
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $clients = $clients ?? \Modules\Sni\Models\Client::orderByDesc('id')->get();
                    @endphp
                    @foreach ($clients as $index => $client)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src="{{ $client->image_path }}"
                                    style="width: 80px; height: 80px; object-fit: cover;"></td>
                            <td>{{ $client->name }}</td>
                            <td>
                                <a href="{{ route('admin.clients.edit', ['client' => $client->id]) }}"
                                    class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.clients.destroy', ['client' => $client->id]) }}">
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

