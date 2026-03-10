@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Social Media
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Social Media</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.links.store') }}">
            @csrf

            <div class="col-md-6 col-sm-6 form-group">
                <label>Platform</label>
                <input class="form-control" type="text" name="platform">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Link</label>
                <input class="form-control" type="text" name="link">
            </div>
            <div class="col-md-6 col-sm-6 form-group">
                <label>Logo</label>
                <input class="jfilestyle" type="file" name="logo">
            </div>

            <div class="col-md-12 col-sm-12">
                <hr>
            </div>
            <div class="col-md-12 col-sm-12 form-group">
                <button class="custom-btn">
                    <span> <i class="fa fa-save"></i> save</span>
                </button>

            </div>

        </form>
    </div><!--End Page content-->
    <div class="page-content">
        <div class="table-responsive-lg-lg">
            <table class="table table-bordered" id="datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Platform</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($links as $index => $link)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src="{{ $link->image_path }}"></td>
                            <td>{{ $link->platform }}</td>
                            <td>{{ $link->link }}</td>
                            <td>
                                <a href="{{ route('admin.links.edit', ['socialMedia' => $link->id]) }}" class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.links.destroy', ['socialMedia' => $link->id]) }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div><!--End Page content-->
@endsection
