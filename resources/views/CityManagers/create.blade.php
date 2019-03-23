@extends('admin')


@section('content')
<a href="{{route('CityManagers.index')}}" class="btn btn-danger">Back</a>
    <form action="{{route('CityManagers.store')}}" method="post" style="margin-left: 20px">
        @csrf
        <div class="form-group row">
                <label for="National_ID" class="col-sm-2 col-form-label" >National_ID</label>
                <input type="text" name="National_ID" class="form-control col-3" placeholder="National_ID">
            </div>

 

           
        <div class="form-group row">
            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">user</label>
            <select class="form-control col-4" name="user_id">
                @foreach($users as $user)
                    <option value="{{$user->id}}" >{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
