@extends('layouts.master')

@section('content')
    <div class="page-content">
        <div class="table-responsive-lg-lg">
            <table class="table table-bordered" id="datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Message</th>
                        <th>Service</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $index => $message)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $message->message }}</td>
                            <td>
                                {{ $message->service->translate(locale())->name ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $message->name }}
                            </td>
                            <td>
                                {{ $message->phone }}
                            </td>
                            <td>
                                {{ $message->email }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
