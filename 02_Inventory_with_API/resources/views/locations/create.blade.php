@extends('layout')

@section('content')
    <div class="container">
        <h2>Create Device</h2>
        <div class="col-2">
            <form method="post" action="{{route('location.store')}}" >
                @csrf
                <p>
                    <strong>Name:</strong>
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </p>
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
