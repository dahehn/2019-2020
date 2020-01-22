@extends('layout')
@section('content')
    <body>
    <h2>Locations List</h2>
    @csrf
    <p>
        <a class="btn btn-default" href="{{route('location.create')}}">Create New Location</a>
        <a class="btn btn-default" href="{{route('device.create')}}">Create New Device</a>
    </p>

    <table class="table table-striped table-hover">
        <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Number of Devices</th>
        <th colspan="2">Actions</th>
        </thead>
        <tbody>
        @foreach(\App\Location::all() as $l)
            <tr>
                <td>
                    {{ $l->id }}
                </td>
                <td>
                    {{ $l->name }}
                </td>
                <td>
                    {{$l->getDeviceNumber($l->id)}}
                </td>
                <td>
                    <a class="btn btn-link" href="{{ route('locations.edit',  $l->id) }}">
                        Details
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </body>
@endsection
