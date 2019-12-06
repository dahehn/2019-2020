@extends('layout')
@section('content')

    <body>
    <form method="post" action="{{route('device.update',$device->id)}}" >
        @method('patch')
        @csrf
        <p>Model: <input type="text" placeholder="{{$device->model}}" name="model"></p>
        <p>Vendor: <input type="text" placeholder="{{$device->vendor}}" name="vendor"></p>
        @if($device->borrowed===true)
            <p>Is already borrowed:<input type="radio" value="true" name="borrowed" checked></p>
            <p>Is not borrowed:<input type="radio" value="false" name="borrowed"  ></p>
        @else
            <p>Is already borrowed:<input type="radio" value="true" name="borrowed" ></p>
             <p>Is not borrowed:<input type="radio" value="false" name="borrowed" checked ></p>
        @endif
        <p>Year<input type="text" placeholder="{{$device->year}}" name="year"></p>
        <table>
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Change location</th>
            </thead>
           <tbody>
           @foreach(\App\Location::all() as $l)
                <tr>
                    <td>
                        {{$l->id}}
                    </td>
                    <td>
                        {{$l->name}}
                    </td>
                    @if($l->id === $device->location_id)
                    <td>
                        <input type="radio" value="{{$l->id}}" name="location" checked >
                    </td>
                        @else
                        <td>
                            <input type="radio" value="{{$l->id}}" name="location" >
                        </td>
                    @endif
                </tr>
           @endforeach
           </tbody>
        </table>

        <button type="submit">
            Change
        </button>
    </form>
    <form method="post" action="{{ route('device.destroy', $device->id) }}">
        {{ method_field("delete") }}
        {{ csrf_field() }}
        <button class="btn btn-link">
            Delete
        </button>
    </form>
    </body>
@endsection
