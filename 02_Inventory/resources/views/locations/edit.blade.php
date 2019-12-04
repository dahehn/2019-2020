@extends('layout')
@section('content')
    <body>
    <h2>Location Details</h2>
    @csrf
    <form method="post" action="{{route('location.update',$location->id)}}">
        @method('patch')
    <p>Location name:  <input type="text" placeholder="{{$location->name}}" name="name"></p>
        <button type="submit" class="btn btn-success">
            Change Name
        </button>
    </form>
    <form method="post" action="{{ route('locations.destroy', $location->id) }}">
        {{ method_field("delete") }}
        {{ csrf_field() }}
        <button class="btn btn-link">
            Delete
        </button>
    </form>
        <table class="table table-striped table-hover">
        <thead>

        <th>Vendor</th>
        <th>Model</th>
        <th>Year</th>
        <th>Borrowed</th>
        <th colspan="2">Actions</th>
        </thead>
        <tbody>
        @foreach($location->getDevices($location->id) as $d)
            <tr>
                <td>{{$d->vendor}}</td>
                <td>{{$d->model}}</td>
                <td>{{$d->year}}</td>
                <td>{{$d->isBorrowed($d->id)}}</td>
                <td>
                    <a class="btn btn-link" href="{{ route('devices.edit',  $d->id) }}">
                        Details
                    </a>
                </td>
            </tr>

        @endforeach
        </tbody>
         </table>
    <a href="{{route('locations.index')}}">
        <button class="btn btn-link">
            Home
        </button>
    </a>
    </body>

@endsection

