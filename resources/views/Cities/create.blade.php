@extends('admin')


@section('content')
<a href="{{route('Cities.index')}}" class="btn btn-danger">Back</a>
    <form action="{{route('Cities.store')}}" method="POST" style="margin-left: 20px">
        @csrf
        <div class="form-group row">
                <label for="city name" class="col-sm-2 col-form-label" >city name</label>
                <input type="text" name="city name" class="form-control col-3" placeholder="city name">
            </div>

            <div class="form-group row">
                <label for="city manager id" class="col-sm-2 col-form-label" >city manager id</label>
                <input type="text" name="city manager id" class="form-control col-3" placeholder="city manager id">
            </div>

            <div class="form-group row">
                <label for="country id" class="col-sm-2 col-form-label" >country id</label>
                <input type="text" name="country id" class="form-control col-3" placeholder="country id">
            </div>

        {{-- <div class="form-group row">
            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">user</label>
            <select class="form-control col-4" name="user_id">
                @foreach($users as $user)
                    <option value="{{$user->id}}" >{{$user->name}}</option>
                @endforeach
            </select>
        </div> --}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
