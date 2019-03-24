@extends('admin')


@section('content')

    <form action="{{route('gyms.update',$gym->id)}}" method="post" enctype="multipart/form-data" style="margin-left: 20px">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label" >Name</label>
            <input type="text" name="name" class="form-control col-3" placeholder="Gym Name" value="{{$gym->name}}">
        </div>
        <div class="form-group row">
            <label for="creator_name" class="col-sm-2 col-form-label" >Creator Name</label>
            <input type="text" name="creator_name"  class="form-control col-3" value="{{$user->name}}">
        </div>
        <div class="form-group row">
            <label for="img" class="col-sm-2 col-form-label" >Img</label>
            @if(Storage::disk('public')->has($gym->name.'-'.$user->name.'.jpg'))
                <img src="{{asset('storage/'.$gym->name.'-'.$user->name.'.jpg')}}" style="width: 200px; height: 200px;" class="img-fluid" alt="Responsive image">
            @endif
            <input type="file" name="img" class="form-control col-3" value="{{$gym->img}}">
        </div>
        <div class="form-group row">
            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">City</label>
            <select class="form-control col-4"  name="city_id">
                @foreach($cities as $city)
                    <option value="{{$city->id}}" >{{$city->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
