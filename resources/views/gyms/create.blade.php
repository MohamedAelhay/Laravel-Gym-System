@extends('admin')


@section('content')

    <form action="{{route('gyms.store')}}" method="post" enctype="multipart/form-data" style="margin-left: 20px">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label" >Name</label>
            <input type="text" name="name" class="form-control col-3" placeholder="Gym Name">
        </div>
        <div class="form-group row">
            <label for="img" class="col-sm-2 col-form-label" >Img</label>
            <input type="file" name="img" class="form-control col-3">
        </div>
        <div class="form-group row">
            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">City</label>
            <select class="form-control col-4" name="user_id">
                @foreach($cities as $city)
                    <option value="{{$city->id}}" >{{$city->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
