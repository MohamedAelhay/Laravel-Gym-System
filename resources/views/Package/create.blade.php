@extends('admin')


@section('content')


<form action="{{route('Package.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Package Name</label>
            <input name="name" type="text" class="form-control" id="name"  placeholder="Enter Package Name">
        </div>
        <div class="form-group">
            <label for="number_of_sessions">No. Of sessions</label>
            <input type="number" name="number_of_sessions" class="form-control"></input>
        </div>
        <div class="form-group">
            <label for="price">Price $ </label>
            <input type="number" name="price" id="price"></input>

        </div>

         <div class="form-group">
            <label for="gym_id">Gym</label>
            <select class="form-control" name="gym_id">
                @foreach($gyms as $gym)
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                @endforeach
            </select>
        </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/package" class="table-edit btn btn-warning">Back</a>
    </form>
@endsection