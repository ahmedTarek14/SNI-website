@extends('layouts.master')
@section('content')
    <div class="page-head">
        <i class="fa fa-list"></i> Pages
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home"></i>home</a>
            </li>
            <li class="active">Pages</li>
        </ul>
    </div>
    <!-- Page content ==========================================-->
    <div class="page-content">
        <form class="row ajax-form" method="post" action="{{ route('admin.pages.store') }}">
            @csrf

            <div class="col-md-12 col-sm-12 form-group">
                <label>Template Name</label>
                <input class="form-control" type="text" name="template" required>
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
                        <th>Template Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $index => $page)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $page->template }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>
                                <a href="{{ route('admin.pages.edit', ['page' => $page->slug]) }}" class="icon-btn green-bc">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="icon-btn red-bc delete-btn"
                                    data-url="{{ route('admin.pages.destroy', ['page' => $page->slug]) }}">
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
