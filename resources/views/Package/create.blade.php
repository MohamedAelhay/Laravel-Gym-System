@extends('admin')


@section('content')
@include('flash-message')


        @yield('content')

<form action="{{route('Package.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Package Name</label>
            <input name="name" type="text" class="form-control" id="name"  placeholder="Enter Package Name">
        </div>
        @if ($errors->has('name'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('name')}}</li>
        </ul>
    </div>
    <br>
    @endif
        <div class="form-group">
            <label for="number_of_sessions">No. Of sessions</label>
            <input type="number" name="number_of_sessions" class="form-control"></input>
        </div>
        @if ($errors->has('number_of_sessions'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('number_of_sessions')}}</li>
        </ul>
    </div>
    <br>
    @endif
        <div class="form-group">
            <label for="price">Price in cent </label>
            <input type="number" name="price" id="price"></input>
        </div>
        @if ($errors->has('price'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('price')}}</li>
        </ul>
    </div>
    <br>
    @endif

         <div class="form-group">
            <label for="gym_id">Gym</label>
            <select class="form-control" name="gym_id">
                @foreach($gyms as $gym)
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                @endforeach
            </select>
        </div>
        @if ($errors->has('gym_id'))
    <div class="alert alert-danger" style="margin: 4px;">
        <ul style="list-style: none;">
                <li>{{ $errors->first('gym_id')}}</li>
        </ul>
    </div>
    <br>
    @endif

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/package" class="table-edit btn btn-warning">Back</a>
    </form>
@endsection
