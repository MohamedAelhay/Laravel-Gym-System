@extends('admin')
@section('content')

<a href="{{route('Cities.index')}}" class="btn btn-danger">Back</a>

 <form action="{{route('Cities.update',$city->id)}}" method="POST">
    @csrf
    @method('put')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   

    <div class="form-group">
        <label for="name">City Name</label>
        <input name="name" value="{{$city->name}}" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="city name">
    </div>



    <div class="form-group">
            <label for="exampleInputPassword1">City Manager Name</label>
            <select class="form-control" name="user_id">
                @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->cityManager->user[0]->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
                <label for="exampleInputPassword1">Country</label>
                <select class="form-control" name="country_id">
                    @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
    

    <button type="submit" class="btn btn-primary">Update</button>
</form>
    
@endsection





