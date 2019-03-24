@extends('admin')


@section('content')
<a href="{{route('CityManagers.index')}}" class="btn btn-danger">Back</a>
    <form action="{{route('CityManagers.store')}}" method="POST" style="margin-left: 20px">
        @csrf
        <div class="form-group row">
                <label for="National_ID" class="col-sm-2 col-form-label" >National_ID</label>
                <input type="text" name="National_ID" class="form-control col-3" placeholder="National_ID">
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label" >name</label>
                <input type="text" name="name" class="form-control col-3" placeholder="name">
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label" >email</label>
                <input type="text" name="email" class="form-control col-3" placeholder="email">
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label" >password</label>
                <input type="text" name="password" class="form-control col-3" placeholder="password">
            </div>
           
            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label" >image</label>
                <input type="text" name="image" class="form-control col-3" placeholder="image">
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
