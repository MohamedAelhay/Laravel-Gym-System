@extends('admin')


@section('content')

<a href="{{route('Cities.index')}}" class="btn btn-danger">Back</a>

 <form action="{{route('Cities.update',$city->id)}}" method="GET">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="name">City Name</label>
        <input name="name" value="{{$city->name}}" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Title">
    </div>
    <div class="form-group">
        <label for="City Manager">City ManagerName</label>
        <input name="City Manager" class="form-control" value="{{$city->city_manager_id}}">
    </div>
    
    <div class="form-group">
         <label for="country name">Country Name</label>
         <input name="country name" class="form-control" value="{{$city->country_id}}">
     </div>

    
 {{-- <div class="form-group">
     <label for="exampleInputPassword1">image</label>
     <img src="{{$cityManager->image}}">
 </div> --}}
<button type="submit" class="btn btn-primary">Update</button>
</form>
    
@endsection





