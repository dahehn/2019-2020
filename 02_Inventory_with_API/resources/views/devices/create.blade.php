@extends('layout')

@section('content')
    <div class="container">
        <h2>Create Device</h2>
        <div>
            <form method="post" action="{{route('device.store')}}" >
                @csrf
                <p>
                    <strong>Device Properties</strong>
                    <input type="text" class="form-control" name="vendor" placeholder="Vendor">
                    <input type="text" class="form-control" name="model" placeholder="Model">
                    <input type="text" class="form-control" name="year" placeholder="Year">
                    <input type="text" class="form-control" name="vendor" placeholder="Name">
                </p>
                <table class="table table-striped table-hover">
                    <th>Location id</th>
                    <th>Location name</th>
                    <th>action</th>
                    <tbody>
                    @foreach(\App\Location::all() as $l)
                        <tr>
                            <td>{{$l->id}}</td>
                            <td>{{$l->name}}</td>
                            <td><input type="radio" name="location" value="{{$l->id}}"></td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled"   >
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <p>
                    <button type="submit"  class="btn btn-success">
                        Create
                    </button>
                    <a href="{{ route('locations.index') }}" class="btn btn-danger">
                        Cancel
                    </a>
                </p>
            </form>
        </div>
    </div>
@endsection
